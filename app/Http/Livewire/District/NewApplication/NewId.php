<?php

namespace App\Http\Livewire\District\NewApplication;

use App\Jobs\RegisterJobseekerToNcs;
use App\Models\Address;
use App\Models\AdminDistrict;
use App\Models\BasicInfo;
use App\Models\District;
use App\Models\NcoDetail;
use App\Models\OnGoingApplication;
use App\Models\User;
use App\Models\UserNco;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\DB;

class NewId extends Component
{
    use WithPagination;

    public $districts;
    public $name;
    public $district;
    public $authDistricts;

    public $approveAllDialog = false;

    public function openApproveAllDialog()
    {
        $this->approveAllDialog = true;
    }

    public function closeApproveAllDialog()
    {
        $this->approveAllDialog = false;
    }

    public function approveAll()
    {
        $pendingForApproval = BasicInfo::where('canEdit', 0)->where('status', 'Verified')->whereIn('district_id', $this->authDistricts)->get();

        foreach ($pendingForApproval as $pending) {
            $number = BasicInfo::where('status', 'Approved')->latest('card_valid_from')->first();
            $basicInfo = BasicInfo::findOrFail($pending->id);

            // $employeeNo = $this->generateEmpNo($number, $basicInfo);
            $employeeNo = $basicInfo->employment_no == null ? $this->generateEmpNo($number, $basicInfo) : $basicInfo->employment_no;

            $basicInfo->status = 'Approved';
            $basicInfo->canEdit = 0;
            if ($basicInfo->card_valid_from == null) {
                $basicInfo->card_valid_from = today();
            }
            if ($basicInfo->card_valid_till == null) {
                $basicInfo->card_valid_till = today()->addYears(3);
            }
            $empNo = $employeeNo;
            if ($basicInfo->employment_no == null) {
                $basicInfo->employment_no = $empNo;
            }
            $image = QrCode::format('svg')
                ->generate(route('qr-code', [
                    $basicInfo->phone_no,
                    $empNo,
                ]));
            $path = "images/qr/$empNo.svg";
            $basicInfo->qr = $path;
            Storage::disk('public')->put($path, $image);
            $basicInfo->save();

            $user = User::where('id', $basicInfo->user_id)->first();
            $user->name = $basicInfo->full_name;
            $user->mobile_no = $basicInfo->phone_no;
            $user->save();

            // generate pdf
            $info = BasicInfo::where('user_id', $basicInfo->user_id)->first();
            $permanent = Address::with('district:id,name')->where('user_id', $basicInfo->user_id)->where('type', 'permanent')->first();
            $authPreferNcoCode = UserNco::where('user_id', $basicInfo->user_id)->where('nco_code_display', '!=', null)->value('nco_code_display');
            $ncoCodeToDisplay = NcoDetail::where('id', $authPreferNcoCode)->value('code');
            $customPaper = array(0, 0, 245.00, 310.80);
            $pdf = \PDF::loadView('web.auth.pdf.card', compact('info', 'permanent', 'ncoCodeToDisplay'))->setPaper($customPaper, 'landscape');
            Storage::disk('public')->put('employment_card/' . $info->employment_no . '_empex_pocket_card.pdf', $pdf->output());

            $onGoing = OnGoingApplication::where('user_id', $basicInfo->user_id)->where('model_name', 'BasicInfo')->where('type', 'New Application')->where('status', '!=', 'Rejected')->first();
            $onGoing->delete();

            RegisterJobseekerToNcs::dispatch($employeeNo, $basicInfo)->delay(now()->addSeconds(6));
        }

        $this->approveAllDialog = false;

        return redirect(route('district-admin.new-application'));
    }

    // public function generateEmpNo($number, $basicInfo)
    // {
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

        // dd('genearet');

        do {
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
            // Log::info('converted ' . $converted);
            $yearCheck = Str::substr($number->employment_no, 5, 4);

            // dd($yearCheck);


            // if ($yearCheck == date('Y')) {
            $converted += 1;
            $gender = $basicInfo->gender == 'Male' ? 'MMZ' : 'FMZ';
            $employeeNo = $gender . $basicInfo->user->address[0]->district->district_code . date('Y') . str_pad($converted, 7, '0', 0);
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





    public function mount()
    {
        $this->authDistricts = AdminDistrict::where('admin_id', auth()->guard('admin')->id())->pluck('district_id')->toArray();
        $this->districts = District::whereIn('id', $this->authDistricts)->orderBy('name', 'ASC')->get();
    }

    public function render()
    {
        return view('livewire.district.new-application.new-id', [
            'basicInfos' => BasicInfo::where('canEdit', 0)
                ->where('status', 'Verified')
                ->whereNull('employment_no')
                ->where('new_id', 'yes')
                ->whereIn('district_id', $this->authDistricts)
                ->with('district')
                ->when($this->name, fn ($q) => $q->where('full_name', 'like', '%' . $this->name . '%'))
                ->when($this->district, fn ($q) => $q->where('district_id', $this->district))
                ->paginate()
        ]);
    }
}
