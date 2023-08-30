<?php

namespace App\Http\Controllers\District;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Admin;
use App\Models\AdminDistrict;
use App\Models\BasicInfo;
use App\Models\EducationQualification;
use App\Models\Experience;
use App\Models\NcoDetail;
use App\Models\OnGoingApplication;
use App\Models\Renew;
use App\Models\UserCanRead;
use App\Models\UserCanSpeak;
use App\Models\UserCanWrite;
use App\Models\UserNco;
use App\Models\UserPhysicalChallenge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->guard('admin')->user()->role_id != 5) {
            abort(401);
        }




        $authDistricts = AdminDistrict::where('admin_id', auth()->guard('admin')->id())->pluck('district_id')->toArray();
        Log::info('auth district', $authDistricts);


        //added by rj
        $user_ids = BasicInfo::query()->whereIn('district_id', $authDistricts)->get()->pluck('user_id');
        // Log::info('district dash' . $user_ids);
        //added by rj

        $verifyPending = BasicInfo::where('canEdit', 0)->whereIn('district_id', $authDistricts)->where('status', 'Pending')->count();
        $approvalPending = BasicInfo::where('canEdit', 0)->whereIn('district_id', $authDistricts)->where('status', 'Verified')->count();
        $renewPending = Renew::where('status', 'Pending')->whereIn('district_id', $authDistricts)->count();


        // $changeVerify = OnGoingApplication::where('type', 'LIKE', 'Change request%')->where('status', 'Pending')->count();
        // $changeApproval = OnGoingApplication::where('type', 'LIKE', 'Change request%')->where('status', 'Verified')->count();


        //added by rj
        $changeVerify = OnGoingApplication::where('type', 'LIKE', 'Change request%')->where('status', 'Pending')->whereIn('user_id', $user_ids)->distinct('user_id')->count();
        $changeApproval = OnGoingApplication::where('type', 'LIKE', 'Change request%')->where('status', 'Verified')->whereIn('user_id', $user_ids)->distinct('user_id')->count();
        //added by rj




        //very new
        $userids = OnGoingApplication::where('type', 'LIKE', 'Change request%')->where('status', 'Pending')->get()->pluck('user_id');


        // $changeApproval = OnGoingApplication::where('type', 'LIKE', 'Change request%')->where('status', 'Verified')->whereIn('user_id',$user_ids)->distinct('user_id')->count();
        //very new
        $employee = BasicInfo::where('canEdit', 0)->whereIn('district_id', $authDistricts)->where('status', 'Approved')->count();

        $adminIds = AdminDistrict::whereIn('district_id', $authDistricts)->pluck('admin_id');
        $official = Admin::whereIn('role_id', [2, 3])->whereIn('id', $adminIds)->where('is_approved', 1)->count();

        return view('district-admin.index', compact(
            'verifyPending',
            'approvalPending',
            'renewPending',
            'changeVerify',
            'changeApproval',
            'employee',
            'official',
        ));
    }

    public function newApplication()
    {
        if (auth()->guard('admin')->user()->role_id != 5) {
            abort(401);
        }

        $authDistricts = AdminDistrict::where('admin_id', auth()->guard('admin')->id())->pluck('district_id')->toArray();

        $pending = BasicInfo::where('status', 'Pending')->whereIn('district_id', $authDistricts)->count();
        $verified = BasicInfo::where('status', 'Verified')->whereIn('district_id', $authDistricts)->whereNull('new_id')->count();
        $newID = BasicInfo::where('status', 'Verified')->whereIn('district_id', $authDistricts)->whereNotNull('new_id')->count();

        return view('district-admin.new-application', compact('pending', 'verified', 'newID'));
    }

    public function pendingApplication($id)
    {
        if (auth()->guard('admin')->user()->role_id != 5) {
            abort(401);
        }

        $basicInfo = BasicInfo::where('id', $id)->where('canEdit', 0)->firstOrFail();
        $addresses = Address::with('state', 'district', 'rdBlock', 'policeStation', 'postOffice')->where('user_id', $basicInfo->user_id)->get();
        //added rj
        $permanentAddress = Address::with('state', 'district', 'rdBlock', 'policeStation', 'postOffice')->where('user_id', $basicInfo->user_id)->where('type', 'permanent')->latest('updated_at')->first();
        $presentAddress = Address::with('state', 'district', 'rdBlock', 'policeStation', 'postOffice')->where('user_id', $basicInfo->user_id)->where('type', 'present')->latest('updated_at')->first();
        //added rj
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

        return view('district-admin.pending-application', compact('basicInfo', 'addresses', 'permanentAddress', 'presentAddress', 'qualifications', 'experiences', 'langRead', 'langWrite', 'langSpoken', 'physical', 'ncoCodeToDisplay', 'ncoFamilySelected'));
    }

    public function verifyApplication($id)
    {
        if (auth()->guard('admin')->user()->role_id != 5) {
            abort(401);
        }

        $basicInfo = BasicInfo::where('id', $id)->where('canEdit', 0)->firstOrFail();
        $addresses = Address::with('state', 'district', 'rdBlock', 'policeStation', 'postOffice')->where('user_id', $basicInfo->user_id)->get();
        //added rj
        $permanentAddress = Address::with('state', 'district', 'rdBlock', 'policeStation', 'postOffice')->where('user_id', $basicInfo->user_id)->where('type', 'permanent')->latest('updated_at')->first();
        $presentAddress = Address::with('state', 'district', 'rdBlock', 'policeStation', 'postOffice')->where('user_id', $basicInfo->user_id)->where('type', 'present')->latest('updated_at')->first();
        //added rj
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

        return view('district-admin.verify-application', compact('basicInfo', 'addresses', 'permanentAddress', 'presentAddress', 'qualifications', 'experiences', 'langRead', 'langWrite', 'langSpoken', 'physical', 'ncoCodeToDisplay', 'ncoFamilySelected'));
    }

    public function employee()
    {
        if (auth()->guard('admin')->user()->role_id != 5) {
            abort(401);
        }

        return view('district-admin.employee');
    }

    public function employeeDetail($id)
    {
        if (auth()->guard('admin')->user()->role_id != 5) {
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

        return view('district-admin.employee-detail', compact('basicInfo', 'addresses', 'qualifications', 'experiences', 'langRead', 'langWrite', 'langSpoken', 'physical', 'ncoCodeToDisplay', 'ncoFamilySelected'));
    }

    public function account()
    {
        if (auth()->guard('admin')->user()->role_id != 5) {
            abort(401);
        }

        return view('district-admin.account');
    }

    public function renew()
    {
        if (auth()->guard('admin')->user()->role_id != 5) {
            abort(401);
        }

        return view('district-admin.renew');
    }
}
