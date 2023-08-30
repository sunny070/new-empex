<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $search = request()->q;
        $sort = request()->sort ?? 'n';

        $newsInformations = News::when($search, function ($q) use ($search) {
            return $q->where('title', 'like', '%' . $search . '%');
        })->when($sort, function ($s) use ($sort) {
            if ($sort == 'n') {
                return $s->orderBy('created_at', 'DESC');
            } else {
                return $s->orderBy('created_at', 'ASC');
            }
        })->orderBy('created_at', 'DESC')->paginate(5);

        return view('web.news.index', compact('newsInformations', 'search', 'sort'));
    }

    public function detail($slug)
    {
        if (!auth()->check()) {
            return redirect(route('web.news'))->with('newsMessage', 'Please login to view details!');
        }

        $news = News::where('slug', $slug)->with('attachments')->firstOrFail();

        return view('web.news.detail', compact('news'));
    }



    // public function detail($slug)
    // {
    //     if (!auth()->check()) {
    //         return redirect(route('web.jobs'))->with('jobMessage', 'Please login to view details!');
    //     }

    //     $job = JobPost::with('admin', 'category', 'type', 'sector', 'attachments')->where('slug', $slug)->firstOrFail();

    //     $userJob = UserJob::firstOrNew([
    //         'user_id' => auth()->id(),
    //         'job_id' => $job->id,
    //     ]);
    //     $userJob->save();

    //     return view('web.jobs.detail', compact('job'));
    // }
}
