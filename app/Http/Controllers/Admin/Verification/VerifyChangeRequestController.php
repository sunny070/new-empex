<?php

namespace App\Http\Controllers\Admin\Verification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VerifyChangeRequestController extends Controller
{
    public function basicInfo($id)
    {
        if (auth()->guard('admin')->user()->role_id != 1) {
            abort(401);
        }

        return view('admin.verification.changeRequestDetails.basicInfo', compact('id'));
    }

    public function address($userId)
    {
        if (auth()->guard('admin')->user()->role_id != 1) {
            abort(401);
        }

        return view('admin.verification.changeRequestDetails.address', compact('userId'));
    }

    public function education($userId)
    {
        if (auth()->guard('admin')->user()->role_id != 1) {
            abort(401);
        }

        return view('admin.verification.changeRequestDetails.education', compact('userId'));
    }

    public function experience($userId)
    {
        if (auth()->guard('admin')->user()->role_id != 1) {
            abort(401);
        }

        return view('admin.verification.changeRequestDetails.experience', compact('userId'));
    }

    public function transfer($id)
    {
        if (auth()->guard('admin')->user()->role_id != 1) {
            abort(401);
        }

        return view('admin.verification.changeRequestDetails.transfer', compact('id'));
    }
}
