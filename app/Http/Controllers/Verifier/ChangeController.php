<?php

namespace App\Http\Controllers\Verifier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChangeController extends Controller
{
	public function index()
	{
		if (auth()->guard('admin')->user()->role_id != 2) {
			abort(401);
		}

		return view('verifier.change.index');
	}

	public function detail($type, $id)
	{
		if (auth()->guard('admin')->user()->role_id != 2) {
			abort(401);
		}

		return view('verifier.change.detail', compact('type', 'id'));
	}
}
