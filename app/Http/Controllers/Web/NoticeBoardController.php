<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\NoticeBoard;
use Illuminate\Http\Request;

class NoticeBoardController extends Controller
{
    public function index()
    {
        $search = request()->q;
        $sort = request()->sort;

        $notices = NoticeBoard::when($search, function ($q) use ($search) {
            return $q->where('title', 'like', '%' . $search . '%');
        })->when($sort, function ($s) use ($sort) {
            if ($sort == 'newest') {
                return $s->orderBy('created_at', 'DESC');
            } else {
                return $s->orderBy('created_at', 'ASC');
            }
        })->orderBy('created_at', 'DESC')->paginate(5);
        return view('web.notice.index', compact('notices', 'search', 'sort'));
    }

    public function detail($slug)
    {
        $notice = NoticeBoard::where('slug', $slug)->firstOrFail();
        return view('web.notice.detail', compact('notice'));
    }
}
