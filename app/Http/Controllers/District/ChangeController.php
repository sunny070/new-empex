<?php

namespace App\Http\Controllers\District;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChangeController extends Controller
{
	public function verification()
	{
		if (auth()->guard('admin')->user()->role_id != 5) {
			abort(401);
		}

		return view('district-admin.change.verification');
	}

	public function verificationDetail($type, $id)
	{
		if (auth()->guard('admin')->user()->role_id != 5) {
			abort(401);
		}

		return view('district-admin.change.verification-detail', compact('type', 'id'));
	}

	public function approval()
	{
		if (auth()->guard('admin')->user()->role_id != 5) {
			abort(401);
		}

		return view('district-admin.change.approval');
	}

	public function approvalDetail($type, $id)
	{
		if (auth()->guard('admin')->user()->role_id != 5) {
			abort(401);
		}

		return view('district-admin.change.approval-detail', compact('type', 'id'));
	}
}
