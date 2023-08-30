<?php

namespace App\Http\Controllers\Verifier;

use App\Http\Controllers\Controller;
use App\Jobs\RegisterJobseekerToNcs;
use App\Jobs\SendStatusSms;
use App\Models\Address;
use App\Models\AdminDistrict;
use App\Models\BasicInfo;
use App\Models\EducationQualification;
use App\Models\Experience;
use App\Models\NcoDetail;
use App\Models\OnGoingApplication;
use App\Models\User;
use App\Models\UserCanRead;
use App\Models\UserCanSpeak;
use App\Models\UserCanWrite;
use App\Models\UserNco;
use App\Models\UserPhysicalChallenge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->guard('admin')->user()->role_id != 2) {
            abort(401);
        }

        $authDistricts = AdminDistrict::where('admin_id', auth()->guard('admin')->id())->pluck('district_id')->toArray();

        $basicInfos = BasicInfo::where('canEdit', 0)
            ->where('status', 'Pending')
            ->whereIn('district_id', $authDistricts)
            ->count();

        $employee = BasicInfo::where('canEdit', 0)
            ->where('status', 'Approved')
            ->whereIn('district_id', $authDistricts)
            ->count();

        $changes = OnGoingApplication::where('type', 'LIKE', 'Change request%')->where('status', 'Pending')->count();

        return view('verifier.index', compact('basicInfos', 'employee', 'changes'));
    }

    public function view($id)
    {
        if (auth()->guard('admin')->user()->role_id != 2) {
            abort(401);
        }

        $basicInfo = BasicInfo::where('id', $id)->where('canEdit', 0)->firstOrFail();
        $addresses = Address::with('state', 'district', 'rdBlock', 'policeStation', 'postOffice')->where('user_id', $basicInfo->user_id)->get();
        $qualifications = EducationQualification::with('qualification', 'subject', 'majorCore')->where('user_id', $basicInfo->user_id)->get();
        $experiences = Experience::where('user_id', $basicInfo->user_id)->get();
        $authPreferNcoCode = UserNco::where('user_id', $basicInfo->user_id)->where('nco_code_display', '!=', null)->value('nco_code_display');
        $ncoCodeToDisplay = NcoDetail::where('id', $authPreferNcoCode)->first();
        $ncoFamilySelected = UserNco::with('family', 'detail')->has('detail')->where('user_id', $basicInfo->user_id)->orderBy('family_id', 'ASC')->get()->groupBy('family.name')->toArray();
        $readLang = UserCanRead::with('language')->where('user_id', $basicInfo->user_id)->get();
        $writeLang = UserCanWrite::with('language')->where('user_id', $basicInfo->user_id)->get();
        $spokenLang = UserCanSpeak::with('language')->where('user_id', $basicInfo->user_id)->get();
        $physicalList = UserPhysicalChallenge::with('physicalChallenge')->where('user_id', $basicInfo->user_id)->get();

        $langRead = '';
        $langWrite = '';
        $langSpoken = '';
        $physical = '';

        foreach ($readLang as $read) {
            $langRead .= $read->language->name;
            if ($readLang->last() != $read) {
                $langRead .= ', ';
            }
        }

        foreach ($writeLang as $write) {
            $langWrite .= $write->language->name;
            if ($writeLang->last() != $write) {
                $langWrite .= ', ';
            }
        }

        foreach ($spokenLang as $spoken) {
            $langSpoken .= $spoken->language->name;
            if ($spokenLang->last() != $spoken) {
                $langSpoken .= ', ';
            }
        }

        foreach ($physicalList as $challenge) {
            $physical .= $challenge->physicalChallenge->name;
            if ($physicalList->last() != $challenge) {
                $physical .= ', ';
            }
        }

        return view('verifier.new', compact('basicInfo', 'addresses', 'qualifications', 'experiences', 'langRead', 'langWrite', 'langSpoken', 'physical', 'ncoCodeToDisplay', 'ncoFamilySelected'));
    }

    public function employment()
    {
        if (auth()->guard('admin')->user()->role_id != 2) {
            abort(401);
        }

        return view('verifier.employment');
    }

    public function employmentDetail($id)
    {
        if (auth()->guard('admin')->user()->role_id != 2) {
            abort(401);
        }

        $basicInfo = BasicInfo::where('id', $id)->where('canEdit', 0)->firstOrFail();
        $addresses = Address::with('state', 'district', 'rdBlock', 'policeStation', 'postOffice')->where('user_id', $basicInfo->user_id)->get();
        $qualifications = EducationQualification::with('qualification', 'subject', 'majorCore')->where('user_id', $basicInfo->user_id)->get();
        $experiences = Experience::where('user_id', $basicInfo->user_id)->get();
        $authPreferNcoCode = UserNco::where('user_id', $basicInfo->user_id)->where('nco_code_display', '!=', null)->value('nco_code_display');
        $ncoCodeToDisplay = NcoDetail::where('id', $authPreferNcoCode)->first();
        $ncoFamilySelected = UserNco::with('family', 'detail')->has('detail')->where('user_id', $basicInfo->user_id)->orderBy('family_id', 'ASC')->get()->groupBy('family.name')->toArray();
        $readLang = UserCanRead::with('language')->where('user_id', $basicInfo->user_id)->get();
        $writeLang = UserCanWrite::with('language')->where('user_id', $basicInfo->user_id)->get();
        $spokenLang = UserCanSpeak::with('language')->where('user_id', $basicInfo->user_id)->get();
        $physicalList = UserPhysicalChallenge::with('physicalChallenge')->where('user_id', $basicInfo->user_id)->get();

        $langRead = '';
        $langWrite = '';
        $langSpoken = '';
        $physical = '';

        foreach ($readLang as $read) {
            $langRead .= $read->language->name;
            if ($readLang->last() != $read) {
                $langRead .= ', ';
            }
        }

        foreach ($writeLang as $write) {
            $langWrite .= $write->language->name;
            if ($writeLang->last() != $write) {
                $langWrite .= ', ';
            }
        }

        foreach ($spokenLang as $spoken) {
            $langSpoken .= $spoken->language->name;
            if ($spokenLang->last() != $spoken) {
                $langSpoken .= ', ';
            }
        }

        foreach ($physicalList as $challenge) {
            $physical .= $challenge->physicalChallenge->name;
            if ($physicalList->last() != $challenge) {
                $physical .= ', ';
            }
        }

        return view('verifier.employmentDetail', compact('basicInfo', 'addresses', 'qualifications', 'experiences', 'langRead', 'langWrite', 'langSpoken', 'physical', 'ncoCodeToDisplay', 'ncoFamilySelected'));
    }

    public function verify($id, $status, $type, Request $request)
    {


        $number = BasicInfo::where('status', 'Approved')->latest('card_valid_from')->first();
        $basicInfo = BasicInfo::findOrFail($id);


        // dd($status);
        $basicInfo->status = $status;
        $basicInfo->notes = $request->notes;
        $basicInfo->canEdit = 0;
        if ($status == 'Approved') {
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
            $basicInfo->qr = $path;
            Storage::disk('public')->put($path, $image);

            $basicInfo->new_id = null;
        }

        if ($status == 'Rejected') {
            $basicInfo->canEdit = 1;
        }

        $basicInfo->save();

        $this->updateOnGoing($basicInfo->user_id, $status, $request->notes);

        $user = User::findOrFail($basicInfo->user_id);

        if ($type == 'approver') {
            $route = 'approver.dashboard';
        } elseif ($type == 'district-admin') {
            $route = 'district-admin.new-application';
        } else {
            $route = 'verifier.dashboard';
        }
        SendStatusSms::dispatch($user->mobile_no, 'apply for new employment card', $status)->delay(30);

        // dd($employeeNo);

        if ($status == 'Approved') {
            RegisterJobseekerToNcs::dispatch($employeeNo, $basicInfo)->delay(now()->addSeconds(6));
        }

        return redirect(route($route));
    }

    // public function generateEmpNo($number, $basicInfo)
    // {
    // 	if ($number == null) {
    // 		$gender = $basicInfo->gender == 'Male' ? 'MMZ' : 'FMZ';
    // 		$employeeNo = $gender . $basicInfo->user->address[0]->district->district_code . date('Y') . str_pad(1, 7, '0', 0);
    // 		return $employeeNo;
    // 	}

    // 	$converted = Str::substr($number->employment_no, 9, strlen($number->employment_no));
    // 	$yearCheck = Str::substr($number->employment_no, 5, 4);

    // 	if ($yearCheck == date('Y')) {
    // 		$converted += 1;
    // 		$gender = $basicInfo->gender == 'Male' ? 'MMZ' : 'FMZ';
    // 		$employeeNo = $gender . $basicInfo->user->address[0]->district->district_code . date('Y') . str_pad($converted, 7, '0', 0);
    // 	} else {
    // 		$gender = $basicInfo->gender == 'Male' ? 'MMZ' : 'FMZ';
    // 		$employeeNo = $gender . $basicInfo->user->address[0]->district->district_code . date('Y') . str_pad(1, 7, '0', 0);
    // 	}
    // 	return $employeeNo;
    // }



    public function generateEmpNo($number, $basicInfo)
    {

        // dd('genrerate');
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


        if (!blank($onGoing)) {

            if ($status == 'Approved') {
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
}
