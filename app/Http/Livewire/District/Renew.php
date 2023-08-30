<?php

namespace App\Http\Livewire\District;

use App\Jobs\SendStatusSms;
use App\Models\AdminDistrict;
use App\Models\BasicInfo;
use App\Models\District;
use App\Models\OnGoingApplication;
use App\Models\Renew as ModelsRenew;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Renew extends Component
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
	public $authDistricts;

	public function openApproveDialog($id, $userId)
	{
		$detail = ModelsRenew::findOrFail($id);

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

	public function closeApproveDialog()
	{
		$this->approveDialog = false;
	}

	public function approveChange()
	{
		$renew = ModelsRenew::findOrFail($this->renewid);
		$renew->status = 'Approved';
		$renew->new_active_from = $this->newActiveFrom;
		$renew->new_active_till = $this->newActiveTill;
		$renew->save();

		$user = User::findOrFail($this->userId);
		SendStatusSms::dispatch($user->mobile_no, 'enrollment renew', 'approved')->delay(now()->addSeconds(5));

		OnGoingApplication::where('type', 'Renewal')->where('model_name', 'Renew')->where('status', '!=', 'Rejected')->where('user_id', $this->userId)->delete();

		$basic = BasicInfo::where('user_id', $this->userId)->where('status','Approved')->latest('updated_at')->first();
		$basic->card_valid_from = $this->newActiveFrom;
		$basic->card_valid_till = $this->newActiveTill;
		$basic->save();

		return redirect(route('district-admin.renew'));
	}

	public function mount()
	{
		$this->authDistricts = AdminDistrict::where('admin_id', auth()->guard('admin')->id())->pluck('district_id')->toArray();
		$this->districts = District::whereIn('id', $this->authDistricts)->orderBy('name', 'ASC')->get();
	}

	public function render()
	{
		return view('livewire.district.renew', [
			'renews' => ModelsRenew::where('status', 'Pending')
				->whereIn('district_id', $this->authDistricts)
				->when($this->district, fn ($q) => $q->where('district_id', $this->district))
				->when($this->name, fn ($q) => $q->where('name', 'like', '%' . $this->name . '%'))
				->with('user', 'district')
				->paginate()
		]);
	}
}
