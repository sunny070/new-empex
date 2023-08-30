<?php

namespace App\Http\Controllers\Admin\Verification;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\BasicInfo;
use App\Models\EducationQualification;
use App\Models\Experience;
use App\Models\NcoDetail;
use App\Models\UserCanRead;
use App\Models\UserCanSpeak;
use App\Models\UserCanWrite;
use App\Models\UserNco;
use App\Models\UserPhysicalChallenge;
use Illuminate\Http\Request;

class ApprovalController extends Controller
{
    public function getApprovalNewApplication()
    {
        if (auth()->guard('admin')->user()->role_id != 1) {
            abort(401);
        }

        return view('admin.approval.newApplication');
    }





    public function getNewIdApplication()
    {
        if (auth()->guard('admin')->user()->role_id != 1) {
            abort(401);
        }

        return view('admin.approval.newIdApplication');
    }










    public function getApproveView($id)
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

        return view('admin.approval.viewVerifiedApplication', compact('basicInfo', 'addresses', 'permanentAddress', 'presentAddress', 'qualifications', 'experiences', 'readLang', 'writeLang', 'spokenLang', 'physicalList', 'ncoCodeToDisplay', 'ncoFamilySelected'));
    }

    public function getApprovalChangeRequest()
    {
        if (auth()->guard('admin')->user()->role_id != 1) {
            abort(401);
        }

        return view('admin.approval.changeRequests');
    }

    // renewal
    public function getApprovalRenewal()
    {
        if (auth()->guard('admin')->user()->role_id != 1) {
            abort(401);
        }

        return view('admin.approval.renewal');
    }
}
