<?php

namespace App\Http\Controllers\Admin\Verification;

use App\Http\Controllers\Controller;
use App\Jobs\RegisterJobseekerToNcs;
use App\Jobs\SendStatusSms;
use App\Models\Address;
use App\Models\BasicInfo;
use App\Models\ChangeAddress;
use App\Models\ChangeBasicInfo;
use App\Models\ChangeEducation;
use App\Models\ChangeExperience;
use App\Models\EducationQualification;
use App\Models\Experience;
use App\Models\NcoDetail;
use App\Models\OnGoingApplication;
use App\Models\RegisteringAuthority;
use App\Models\RegisteringAuthorityDistrict;
use App\Models\Transfer;
use App\Models\User;
use App\Models\UserCanRead;
use App\Models\UserCanSpeak;
use App\Models\UserCanWrite;
use App\Models\UserNco;
use App\Models\UserPhysicalChallenge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use PDF;

class VerificationController extends Controller
{
    public function getVerifyNewApplication()
    {
        if (auth()->guard('admin')->user()->role_id != 1) {
            abort(401);
        }

        return view('admin.verification.newApplication');
    }

    public function getVerifyView($id)
    {
        if (auth()->guard('admin')->user()->role_id != 1) {
            abort(401);
        }

        $basicInfo = BasicInfo::findOrFail($id);

        $addresses = Address::with('state', 'district', 'rdBlock', 'policeStation', 'postOffice')->where('user_id', $basicInfo->user_id)->get();
        //added rj
        $permanentAddress = Address::with('state', 'district', 'rdBlock', 'policeStation', 'postOffice')->where('user_id', $basicInfo->user_id)->where('type', 'permanent')->latest('updated_at')->first();
        $presentAddress = Address::with('state', 'district', 'rdBlock', 'policeStation', 'postOffice')->where('user_id', $basicInfo->user_id)->where('type', 'present')->latest('updated_at')->first();
        //added rj

        $qualifications = EducationQualification::with('qualification', 'subject', 'majorCore')->where('user_id', $basicInfo->user_id)->get();

        $experiences = Experience::where('user_id', $basicInfo->user_id)->get();

        $readLang = UserCanRead::with('language')->where('user_id', $basicInfo->user_id)->get();

        $writeLang = UserCanWrite::with('language')->where('user_id', $basicInfo->user_id)->get();

        $spokenLang = UserCanSpeak::with('language')->where('user_id', $basicInfo->user_id)->get();

        $physicalList = UserPhysicalChallenge::with('physicalChallenge')->where('user_id', $basicInfo->user_id)->get();

        $authPreferNcoCode = UserNco::where('user_id', $basicInfo->user_id)->where('nco_code_display', '!=', null)->value('nco_code_display');
        $ncoCodeToDisplay = NcoDetail::where('id', $authPreferNcoCode)->first();
        $ncoFamilySelected = UserNco::with('family', 'detail')->has('detail')->where('user_id', $basicInfo->user_id)->orderBy('family_id', 'ASC')->get()->groupBy('family.name')->toArray();

        return view('admin.verification.viewNewApplication', compact('basicInfo', 'addresses', 'permanentAddress', 'presentAddress', 'qualifications', 'experiences', 'readLang', 'writeLang', 'spokenLang', 'physicalList', 'ncoCodeToDisplay', 'ncoFamilySelected'));
    }

    public function postVerify($id, $status, $router = null, Request $request)
    {
        $number = BasicInfo::where('status', 'Approved')->latest('card_valid_from')->first();
        $basicInfo = BasicInfo::findOrFail($id);

        // if ($status == 'Approved') {
        // }
        // dd($status);

        $basicInfo->status = $status;
        $basicInfo->notes = $request->notes;
        $basicInfo->canEdit = 0;
        if ($status == 'Approved') {
            // $employeeNo = $this->generateEmpNo($number, $basicInfo);
            $employeeNo = $basicInfo->employment_no == null ? $this->generateEmpNo($number, $basicInfo) : $basicInfo->employment_no;

            if ($basicInfo->new_id == null) {
                $basicInfo->card_valid_from = today();
            }
            if ($basicInfo->new_id == null) {
                $basicInfo->card_valid_till = today()->addYears(3);
            }
            $empNo = $basicInfo->employment_no == null ? $employeeNo : $basicInfo->employment_no;
            if ($basicInfo->employment_no == null) {
                $basicInfo->employment_no = $empNo;
            }
            $image = QrCode::format('svg')
                ->generate(route('qr-code', [
                    $basicInfo->phone_no,
                    $empNo,
                ]));
            $path = "images/qr/$empNo.svg";
            // $basicInfo->qr = $path;
            Storage::disk('public')->put($path, $image);

            $basicInfo->new_id = null;
        }

        if ($status == 'Rejected') {
            $basicInfo->canEdit = 1;
        }
        $basicInfo->save();

        if ($status == 'Approved') {
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
            $authorityDistrict = RegisteringAuthorityDistrict::where('district_id', $info->district_id)->value('registering_authority_id');
            $signature = RegisteringAuthority::where('id', $authorityDistrict)->first();
            $pdf = PDF::loadView('web.auth.pdf.card', compact('info', 'permanent', 'ncoCodeToDisplay', 'signature'))->setPaper($customPaper, 'landscape');
            Storage::disk('public')->put('employment_card/' . $info->employment_no . '_empex_pocket_card.pdf', $pdf->output());
        }

        $this->updateOnGoing($basicInfo->user_id, $status, $request->notes);

        $user = User::findOrFail($basicInfo->user_id);
        $route = 'admin.verify.new.application';
        if ($status != 'Verified') {
            $route = 'admin.approve.new.application';
        }
        SendStatusSms::dispatch($user->mobile_no, 'apply for new employment card', $status)->delay(30);

        if ($status == 'Approved') {
            // info('ncs');
            // dd($employeeNo);
            RegisterJobseekerToNcs::dispatch($employeeNo, $basicInfo)->delay(now()->addSeconds(6));
        }

        return redirect()->route($router ?? $route)->withSuccess("Profile $request->status");
    }

    public function generateEmpNo($number, $basicInfo)
    {

        // dd($basicInfo->user->address[0]);
        $increment = 0;
        do {
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
            // Log::info('converted ' . $converted);
            $yearCheck = Str::substr($number->employment_no, 5, 4);

            // dd($yearCheck);


            // if ($yearCheck == date('Y')) {
            $converted += $increment;
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

    public function updateOnGoing($user_id, $status, $notes)
    {
        $onGoing = OnGoingApplication::where('user_id', $user_id)->where('model_name', 'BasicInfo')->where('type', 'New Application')->where('status', '!=', 'Rejected')->first();
        Log::info('ongoing: ' . $onGoing);
        if (!blank($onGoing)) {

            if ($status == 'Approved' && filled($onGoing)) {
                $onGoing?->delete();
            } else {
                $onGoing->status = $status;
                $onGoing->verified_date = today();
                if ($status == 'Rejected') {
                    $onGoing->rejected_date = today();
                    $onGoing->rejection_note = $notes;
                }
                $onGoing->save();
            }
        }
    }

    public function getVerifyChangeRequest()
    {
        if (auth()->guard('admin')->user()->role_id != 1) {
            abort(401);
        }

        return view('admin.verification.changeRequest');
    }




    public function regenerateEmpNo()
    {

        // return 'test';
        $results = DB::table('basic_infos')
            ->where('status', 'Approved')
            ->select('full_name', 'employment_no', 'id', DB::raw('COUNT(*) as `count`'))
            ->groupBy('employment_no')
            ->havingRaw('COUNT(*) > 1')
            ->get()->pluck('employment_no');

        // dd($results);p


        $users =   BasicInfo::query()->whereIn('employment_no', $results)->pluck('user_id');



        // return $results;

        $duplicate =  BasicInfo::query()->whereIn('employment_no', $results)->update([
            'employment_no' => null,
            'status' => 'Verified',
            'new_id' => 'yes'

        ]);

        $users = OnGoingApplication::query()->whereIn('user_id', $users)->update([
            'status' => 'Verified'
        ]);

        return 'Updated';
    }
}
