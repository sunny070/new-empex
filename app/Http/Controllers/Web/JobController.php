<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Department;
use App\Models\JobPost;
use App\Models\Type;
use App\Models\UserJob;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $totalGovt = JobPost::where('category_id', 3)->count();
        $totalPublic = JobPost::where('category_id', 2)->count();
        $totalPrivate = JobPost::where('category_id', 1)->count();

        $search = request()->q;
        $sort = request()->sort ?? 'n';
        $filter = request()->filter ?? 'all';

        $jobLists = JobPost::where('published', 1)
            ->when($search, function ($q) use ($search) {
                return $q->where('title', 'like', '%' . $search . '%');
            })
            ->when($sort, function ($s) use ($sort) {
                if ($sort == 'n') {
                    return $s->orderBy('created_at', 'DESC');
                } else if ($sort == 'o') {
                    return $s->orderBy('created_at', 'ASC');
                } else {
                    return $s->orderBy('due_date_of_submission', 'ASC');
                }
            })
            ->when($filter, function ($f) use ($filter) {
                if ($filter == 'private') {
                    return $f->where('category_id', 1);
                } elseif ($filter == 'public') {
                    return $f->where('category_id', 2);
                } elseif ($filter == 'govt') {
                    return $f->where('category_id', 3);
                } else {
                    return $f;
                }
            })
            ->orderBy('created_at', 'DESC')
            ->paginate(5);

        return view('web.jobs.index', compact('totalGovt', 'totalPublic', 'totalPrivate', 'jobLists', 'search', 'sort', 'filter'));
    }

    public function detail($slug)
    {
        if (!auth()->check()) {
            return redirect(route('web.jobs'))->with('jobMessage', 'Please login to view details!');
        }

        $job = JobPost::with('admin', 'category', 'type', 'sector', 'attachments')->where('slug', $slug)->firstOrFail();

        $userJob = UserJob::firstOrNew([
            'user_id' => auth()->id(),
            'job_id' => $job->id,
        ]);
        $userJob->save();

        return view('web.jobs.detail', compact('job'));
    }
}
