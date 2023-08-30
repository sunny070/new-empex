<?php

namespace App\Http\Controllers\District;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DistrictReportController extends Controller
{
	public function getTotalRegistration()
	{
		if (auth()->guard('admin')->user()->role_id != 5) {
			abort(401);
		}

		return view('district.reports.totalRegistrationReport');
	}

	public function getRegisteredUser()
	{
		if (auth()->guard('admin')->user()->role_id != 5) {
			abort(401);
		}

		return view('district.reports.registered-user');
	}

}
