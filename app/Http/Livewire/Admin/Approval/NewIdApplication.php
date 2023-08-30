<?php

namespace App\Http\Livewire\Admin\Approval;

use App\Jobs\RegisterJobseekerToNcs;

use App\Models\Address;
use App\Models\BasicInfo;
use App\Models\District;
use App\Models\NcoDetail;
use App\Models\OnGoingApplication;
use App\Models\UserNco;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class NewIdApplication extends Component
{
    use WithPagination;

    public $districts;
    public $name;
    public $district;

    public $approveAllDialog = false;
    public $approveDialog = false;
    public $approveKey = false;

    public function openApproveAllDialog()
    {
        $this->approveAllDialog = true;
    }


    public function openApproveDialog($id)
    {
        $this->approveDialog =  true;
        $this->approveKey = $id;
    }

    public function closeApproveAllDialog()
    {
        $this->approveAllDialog = false;
    }
    public function closeApproveDialog()
    {
        $this->approveDialog = false;
    }

    public function approveID()
    {
        // dd(BasicInfo::query()->where('employment_no', 'like', '%MMZ0120230000001%')->count());
        // dd(BasicInfo::query()->where('id',6)->first());
        // dd(DB::table('basic_infos')->where('employment_no',  'like', 'MMZ0120230000001')->exists());

        $info = BasicInfo::query()->find($this->approveKey);
        // dd($this->generateEmpNo(1, $info));
        $info->notify_sms = 'yes';
        $info->new_id = null;
        $info->status = 'Approved';
        $info->employment_no = $this->generateEmpNo(1, $info);
        $this->updateOnGoing($info->user_id, 'Approved', 'regenerated');
        // dd($this->generateEmpNo(1, $info));
        $info->save();
        return redirect(route('admin.approve.new.id'));
    }

    public function approveAll()
    {
        // dd('approve all');
        $pendingForApproval = BasicInfo::query()->where('status', 'Verified')
            ->whereNull('employment_no')
            ->where('new_id', 'yes')->get()->map(function (BasicInfo $info) {
                $info->notify_sms = 'yes';
                $info->new_id = null;
                $info->status = 'Approved';
                $info->employment_no = $this->generateEmpNo(1, $info);


                $this->updateOnGoing($info->user_id, 'Approved', 'regenerated');
                $info->save();
                Log::info('info: ' . $info);
            });
        // dd('approve all');
        // dd($pendingForApproval);


        return redirect(route('admin.approve.new.id'));
    }

    // public function generateEmpNo($number, $basicInfo)
    // {
    //     Log::info('empno: ' . $number);
    //     Log::info('basic info: ' . $basicInfo);
    //     if ($number == null) {
    //         $gender = $basicInfo->gender == 'Male' ? 'MMZ' : 'FMZ';
    //         $employeeNo = $gender . $basicInfo->user->address[0]->district->district_code . date('Y') . str_pad(1, 7, '0', 0);
    //         return $employeeNo;
    //     }

    //     $converted = Str::substr($number->employment_no, 9, strlen($number->employment_no));
    //     $yearCheck = Str::substr($number->employment_no, 5, 4);

    //     if ($yearCheck == date('Y')) {
    //         $converted += 1;
    //         $gender = $basicInfo->gender == 'Male' ? 'MMZ' : 'FMZ';
    //         $employeeNo = $gender . $basicInfo->user->address[0]->district->district_code . date('Y') . str_pad($converted, 7, '0', 0);
    //     } else {
    //         $gender = $basicInfo->gender == 'Male' ? 'MMZ' : 'FMZ';
    //         $employeeNo = $gender . $basicInfo->user->address[0]->district->district_code . date('Y') . str_pad(1, 7, '0', 0);
    //     }
    //     return $employeeNo;
    // }


    public function generateEmpNo($number, $basicInfo)
    {
        // dd($basicInfo);
        Log::info('new emp');
        // dd($basicInfo->user->address[0]);
        $increment = 0;
        do {
            Log::info('new emp increment');

            $increment += 1;
            // $number = BasicInfo::where('status', 'Approved')->latest('card_valid_from')->first();
            $number = BasicInfo::query()->whereNotNull('employment_no')->latest('created_at')->first();

            // dd($number);

            if ($number == null) {
                $gender = $basicInfo->gender == 'Male' ? 'MMZ' : 'FMZ';
                $employeeNo = $gender . $basicInfo->user->address[0]->district->district_code . date('Y') . str_pad(1, 7, '0', 0);
                return $employeeNo;
            }

            $converted = Str::substr($number->employment_no, 9, strlen($number->employment_no));

            // dd($converted);

            // dd($converted);
            // Log::info('converted ' . $converted);
            $yearCheck = Str::substr($number->employment_no, 5, 4);

            // dd($yearCheck);


            // if ($yearCheck == date('Y')) {
            $converted = $increment;
            $gender = $basicInfo->gender == 'Male' ? 'MMZ' : 'FMZ';
            // dd($basicInfo->user->getAddr());
            $employeeNo = $gender . $basicInfo->user->getAddr() . date('Y') . str_pad($converted, 7, '0', 0);
            // dd($employeeNo);

            // }
            // else {
            //     $gender = $basicInfo->gender == 'Male' ? 'MMZ' : 'FMZ';
            //     $employeeNo = $gender . $basicInfo->user->address[0]->district->district_code . date('Y') . str_pad(1, 7, '0', 0);
            // }
            // Log::info('empno: ' . $employeeNo);
            // dd($employeeNo);
        } while (DB::table('basic_infos')->where('employment_no', 'like', "%$employeeNo%")->exists());
        // } while(BasicInfo::query()->firstWhere('employment_no',$employeeNo)->exists());

        return $employeeNo;
    }


    public function updateOnGoing($user_id, $status, $notes)
    {
        $onGoing = OnGoingApplication::where('user_id', $user_id)->where('model_name', 'BasicInfo')->where('type', 'New Application')->where('status', '!=', 'Rejected')->first();
        if (!blank($onGoing)) {

            $onGoing?->delete();
        }
    }

    public function mount()
    {
        $this->districts = District::orderBy('name', 'ASC')->get();
    }

    public function render()
    {
        return view('livewire.admin.approval.new-id-application', [
            'basicInfos' => BasicInfo::query()->where('canEdit', 0)
                ->where('status', 'Verified')
                ->whereNull('employment_no')
                ->where('new_id', 'yes')
                ->with('user', 'district')
                ->when($this->name, function ($q) {
                    return $q->where('full_name', 'like', '%' . $this->name . '%');
                })
                ->when($this->district, function ($q) {
                    $q->where('district_id', $this->district);
                })
                ->paginate()
        ]);
    }
}
