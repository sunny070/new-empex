<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Department;
use App\Models\JobPost;
use App\Models\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class JobsPostController extends Controller
{
  public function getJobsPost()
  {
    if (auth()->guard('admin')->user()->role_id != 1) {
      abort(401);
    }

    $jobs = JobPost::where('published', 1)->orderBy('created_at', 'desc')->paginate();
    $unpublished = JobPost::where('published', 0)->count();
    return view('admin.jobPost', compact('jobs', 'unpublished'));
  }

  public function createJobsPost()
  {
    if (auth()->guard('admin')->user()->role_id != 1) {
      abort(401);
    }

    return view('admin.createJobPost');
  }

  public function editJob($id)
  {
    if (auth()->guard('admin')->user()->role_id != 1) {
      abort(401);
    }

    $job = JobPost::findOrFail($id);
    $departments = Department::get();
    return view('admin.editJobPost', compact('job', 'departments'));
  }

  public function storeImage($path, $image)
  {
    $path = Storage::disk('public')->put($path, $image, 'public');
    return $path;
  }

  public function unpublished()
  {
    if (auth()->guard('admin')->user()->role_id != 1) {
      abort(401);
    }

    $jobs = JobPost::where('published', 0)->orderBy('created_at', 'desc')->paginate();

    return view('admin.unpublishedJobs', compact('jobs'));
  }

  public function viewJob($id)
  {
    if (auth()->guard('admin')->user()->role_id != 1) {
      abort(401);
    }

    $id = $id;

    return view('admin.viewJobPost', compact('id'));
  }
}
