<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Models\BasicInfo;
use Illuminate\Http\Request;

class ChangeRequestController extends Controller
{
    public function nco()
    {
        $canChange = BasicInfo::where('user_id', auth()->id())->where('canEdit', 0)->first();
        if (!$canChange) {
            return redirect(route('auth.employee.changerequest'))->with('message', 'Please register first to make change!');
        }
        if ($canChange->status != 'Approved') {
            return redirect(route('auth.employee.changerequest'))->with('message', 'Application not approved!');
        }

        return view('web.auth.employee.change-request.nco');
    }

    public function basicInfo()
    {
        $canChange = BasicInfo::where('user_id', auth()->id())->where('canEdit', 0)->latest('updated_at')->first();
        if (!$canChange) {
            return redirect(route('auth.employee.changerequest'))->with('message', 'Please register first to make change!');
        }
        if ($canChange->status != 'Approved') {
            return redirect(route('auth.employee.changerequest'))->with('message', 'Application not approved!');
        }

        return view('web.auth.employee.change-request.basic_info');
    }

    public function address()
    {
        $canChange = BasicInfo::where('user_id', auth()->id())->where('canEdit', 0)->first();
        if (!$canChange) {
            return redirect(route('auth.employee.changerequest'))->with('message', 'Please register first to make change!');
        }
        if ($canChange->status != 'Approved') {
            return redirect(route('auth.employee.changerequest'))->with('message', 'Application not approved!');
        }

        return view('web.auth.employee.change-request.address');
    }

    public function education()
    {
        $canChange = BasicInfo::where('user_id', auth()->id())->where('canEdit', 0)->first();
        if (!$canChange) {
            return redirect(route('auth.employee.changerequest'))->with('message', 'Please register first to make change!');
        }
        if ($canChange->status != 'Approved') {
            return redirect(route('auth.employee.changerequest'))->with('message', 'Application not approved!');
        }

        return view('web.auth.employee.change-request.education');
    }

    public function experience()
    {
        $canChange = BasicInfo::where('user_id', auth()->id())->where('canEdit', 0)->first();
        if (!$canChange) {
            return redirect(route('auth.employee.changerequest'))->with('message', 'Please register first to make change!');
        }
        if ($canChange->status != 'Approved') {
            return redirect(route('auth.employee.changerequest'))->with('message', 'Application not approved!');
        }

        return view('web.auth.employee.change-request.experience');
    }

    public function transfer()
    {
        $canChange = BasicInfo::where('user_id', auth()->id())->where('canEdit', 0)->first();
        if (!$canChange) {
            return redirect(route('auth.employee.changerequest'))->with('message', 'Please register first to make change!');
        }
        if ($canChange->status != 'Approved') {
            return redirect(route('auth.employee.changerequest'))->with('message', 'Application not approved!');
        }

        return view('web.auth.employee.change-request.transfer');
    }
}
