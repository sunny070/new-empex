<?php

namespace App\Http\Livewire\Admin;

use App\Jobs\SendStatusSms;
use App\Models\BasicInfo;
use App\Models\District;
use App\Models\OnGoingApplication;
use App\Models\Renew;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class EnrollmentRenew extends Component
{
    use WithPagination;

    public $approveDialog = false;
    public $rejectDialog = false;
    public $rejectionNote;
    public $renewid;
    public $userId;

    public $preActiveFrom, $preActiveTill;
    public $newActiveFrom, $newActiveTill;
    public $remainingDate = 0;

    public $districts;
    public $district;
    public $name;

    public function openApproveDialog($id, $userId)
    {
        $detail = Renew::findOrFail($id);

        $lastActiveDate = Carbon::parse($detail->active_till);
        $dateTillRenew = today()->diffInDays($lastActiveDate, false);

        $this->preActiveFrom = $detail->active_from;
        $this->preActiveTill = $detail->active_till;
        $this->newActiveFrom = today();
        if ($dateTillRenew > 0) {
            $this->remainingDate = $dateTillRenew;
            $this->newActiveTill = today()->addYears(3)->addDays($dateTillRenew);
        } else {
            $this->newActiveTill = today()->addYears(3);
        }

        $this->renewid = $id;
        $this->userId = $userId;
        $this->approveDialog = true;
    }




    public function openRejectDialog($id, $userId)
    {
        $detail = Renew::findOrFail($id);



        $this->renewid = $id;
        $this->userId = $userId;
        $this->rejectDialog = true;
    }


    public function closeApproveDialog()
    {
        $this->approveDialog = false;
    }
    public function closeRejectDialog()
    {
        $this->rejectDialog = false;
    }

    public function approveChange()
    {
        $renew = Renew::findOrFail($this->renewid);
        $renew->status = 'Approved';
        $renew->new_active_from = $this->newActiveFrom;
        $renew->new_active_till = $this->newActiveTill;
        $renew->save();

        $user = User::findOrFail($this->userId);
        SendStatusSms::dispatch($user->mobile_no, 'enrollment renew', 'approved')->delay(30);

        OnGoingApplication::where('type', 'Renewal')->where('model_name', 'Renew')->where('status', '!=', 'Rejected')->where('user_id', $this->userId)->delete();

        $basic = BasicInfo::where('user_id', $this->userId)->where('status','Approved')->latest('updated_at')->first();
        $basic->card_valid_from = $this->newActiveFrom;
        $basic->card_valid_till = $this->newActiveTill;
        $basic->save();

        return redirect(route('admin.approve.renewal'));
    }



    public function rejectChange()
    {
        $renew = Renew::findOrFail($this->renewid);
        $renew->status = 'Rejected';


        $renew->save();

        $user = User::findOrFail($this->userId);
        SendStatusSms::dispatch($user->mobile_no, 'enrollment renew', 'rejected')->delay(30);

        $ongoing = OnGoingApplication::where('type', 'Renewal')->where('model_name', 'Renew')->where('status', '!=', 'Rejected')->where('user_id', $this->userId)->first();
        $ongoing->status = 'Rejected';
        $ongoing->rejection_note = $this->rejectionNote;
        $ongoing->save();


        return redirect(route('admin.approve.renewal'));
    }

    public function mount()
    {
        $this->districts = District::orderBy('name', 'ASC')->get();
    }

    public function render()
    {
        return view('livewire.admin.enrollment-renew', [
            'renews' => Renew::where('status', 'Pending')
                ->when($this->district, fn ($q) => $q->where('district_id', $this->district))
                ->when($this->name, fn ($q) => $q->where('name', 'like', '%' . $this->name . '%'))
                ->with('user', 'district')
                ->paginate()
        ]);
    }
}
