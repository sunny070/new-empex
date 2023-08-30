<?php

namespace App\Http\Controllers\Approver;

use App\Http\Controllers\Controller;
use App\Models\ChangeAddress;
use App\Models\ChangeBasicInfo;
use App\Models\ChangeEducation;
use App\Models\ChangeExperience;
use App\Models\Transfer;
use Illuminate\Http\Request;

class ChangeController extends Controller
{
	public function index()
	{
		if (auth()->guard('admin')->user()->role_id != 3) {
			abort(401);
		}

		return view('approver.change.index');
	}

	public function detail($type, $id)
	{
		if (auth()->guard('admin')->user()->role_id != 3) {
			abort(401);
		}

		return view('approver.change.detail', compact('type', 'id'));
	}
}
