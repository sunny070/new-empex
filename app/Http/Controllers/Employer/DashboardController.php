<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\JobFile;
use App\Models\JobNco;
use App\Models\JobPost;
use App\Models\UserJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
	public function index()
	{
		if (auth()->guard('admin')->user()->role_id != 4) {
			if (auth()->guard('admin')->user()->role_id == 2) {
				return redirect(route('verifier.dashboard'));
			} elseif (auth()->guard('admin')->user()->role_id == 3) {
				return redirect(route('approver.dashboard'));
			} else {
				return redirect(route('dashboard'));
			}
		}

		$jobPosts = JobPost::where('created_by', auth()->guard('admin')->user()->id)->orderBy('created_at', 'DESC')->paginate();
		$totalNoOfPost = JobPost::where('created_by', auth()->guard('admin')->user()->id)->sum('no_of_post');
		return view('employer.index', compact('jobPosts', 'totalNoOfPost'));
	}

	public function jobCreate()
	{
		if (auth()->guard('admin')->user()->role_id != 4) {
			abort(401);
		}

		if (auth()->guard('admin')->user()->active == 0) {
			return back();
		} else {
			return view('employer.job');
		}
	}

	public function jobEdit($id)
	{
		if (auth()->guard('admin')->user()->role_id != 4) {
			abort(401);
		}

		if (auth()->guard('admin')->user()->active == 0) {
			return back();
		} else {
			return view('employer.job', compact('id'));
		}
	}

	public function jobDelete($id)
	{
		if (auth()->guard('admin')->user()->role_id != 4) {
			abort(401);
		}

		JobNco::where('job_post_id', $id)->delete();
		UserJob::where('job_id', $id)->delete();

		$jobFiles = JobFile::where('job_post_id', $id)->get();
		foreach ($jobFiles as $job) {
			Storage::disk('public')->delete($job->file);
			$job->delete();
		}
		JobPost::findOrFail($id)->delete();
		return back();
	}
}
