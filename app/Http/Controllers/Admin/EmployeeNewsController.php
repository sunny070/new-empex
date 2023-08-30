<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsFile;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EmployeeNewsController extends Controller
{
    public function getEmployeeNews()
    {
        if (auth()->guard('admin')->user()->role_id != 1) {
            abort(401);
        }

        $news = News::paginate();
        return view('admin.employeeNews', compact('news'));
    }

    public function createNews()
    {
        if (auth()->guard('admin')->user()->role_id != 1) {
            abort(401);
        }

        return view('admin.createNews');
    }

    public function saveNews(Request $request)
    {
        // dd($request->file());
        if (auth()->guard('admin')->user()->role_id != 1) {
            abort(401);
        }

        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
        ]);

        $slug = Str::slug($request->title, '-');
        $news = new News;
        $news->title = $request->title;
        $news->slug = $slug;
        $news->content = $request->content;

        $news->save();
        if ($request->hasFile('attachment')) {
            $jobFile = new NewsFile();
            $jobFile->news_id = $news->id;
            $jobFile->file = $request->file('attachment')->storePublicly('job_attachments', 'public');
            $jobFile->file_name = $request->file('attachment')->getClientOriginalName();
            $jobFile->file_size = $this->formatBytes($request->file('attachment')->getSize());
            $jobFile->save();
        }
        return redirect()->route('employeeNews');
    }

    function formatBytes($size, $precision = 1)
    {
        $base = log($size, 1024);
        $suffixes = array('B', 'Kb', 'Mb', 'Gb', 'Tb');
        return round(pow(1024, $base - floor($base)), $precision) . ' ' . $suffixes[floor($base)];
    }
    public function editEmployeeNews($id)
    {
        if (auth()->guard('admin')->user()->role_id != 1) {
            abort(401);
        }

        $news = News::findOrFail($id);
        $news_file = NewsFile::query()->firstWhere('news_id', $id);

        return view('admin.editNews', compact('news', 'news_file'));
    }

    public function updateEmployeeNews($id, Request $request)
    {
        if (auth()->guard('admin')->user()->role_id != 1) {
            abort(401);
        }

        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
        ]);

        $slug = Str::slug($request->title, '-');
        $news = News::findOrFail($id);
        $news->title = $request->title;
        $news->slug = $slug;
        $news->content = $request->content;
        $news->save();


        if ($request->hasFile('attachment')) {
            $news->attachments()->delete();
            $jobFile = new NewsFile();
            $jobFile->news_id = $news->id;
            $jobFile->file = $request->file('attachment')->storePublicly('job_attachments', 'public');
            $jobFile->file_name = $request->file('attachment')->getClientOriginalName();
            $jobFile->file_size = $this->formatBytes($request->file('attachment')->getSize());
            $jobFile->save();
        }
        return redirect()->route('employeeNews');
    }
}
