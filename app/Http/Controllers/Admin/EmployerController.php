<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\SendEmployerStatus;
use App\Models\Admin;
use App\Models\Organization;
use App\Models\OrganizationAddress;
use Illuminate\Http\Request;

class EmployerController extends Controller
{
	public function index()
	{
		if (auth()->guard('admin')->user()->role_id != 1) {
			abort(401);
		}

		return view('admin.employer.index');
	}

	public function detail($id)
	{
		if (auth()->guard('admin')->user()->role_id != 1) {
			abort(401);
		}

		$data = Admin::where('id', $id)
			->with([
				'organization' => function ($org) {
					return $org->with('category', 'type', 'sector');
				},
				'address' => function ($add) {
					return $add->with('state', 'district');
				}
			])
			->firstOrFail();

		return view('admin.employer.detail', compact('data'));
	}

	public function reject($id)
	{
		if (auth()->guard('admin')->user()->role_id != 1) {
			abort(401);
		}

		Organization::where('admin_id', $id)->delete();
		OrganizationAddress::where('admin_id', $id)->delete();
		$emp = Admin::findOrFail($id);
		SendEmployerStatus::dispatch($emp->contactNo, 'Rejected')->delay(now()->addSeconds(5));
		$emp->delete();

		return redirect(route('admin.employer'));
	}

	public function approve($id)
	{
		if (auth()->guard('admin')->user()->role_id != 1) {
			abort(401);
		}

		$data = Admin::findOrFail($id);
		$data->is_approved = 1;
		$data->save();

		SendEmployerStatus::dispatch($data->contactNo, 'Approved')->delay(now()->addSeconds(5));
		return back();
	}
}
