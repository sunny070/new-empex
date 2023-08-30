<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\News;
use App\Models\Placement;
use Illuminate\Http\Request;

class PlacementController extends Controller
{
    // public function index()
    // {
    //     $search = request()->q;
    //     $sort = request()->sort ?? 'n';

    //     $newsInformations = News::when($search, function ($q) use ($search) {
    //         return $q->where('title', 'like', '%' . $search . '%');
    //     })->when($sort, function ($s) use ($sort) {
    //         if ($sort == 'n') {
    //             return $s->orderBy('created_at', 'DESC');
    //         } else {
    //             return $s->orderBy('created_at', 'ASC');
    //         }
    //     })->orderBy('created_at', 'DESC')->paginate(5);

    //     return view('web.news.index', compact('newsInformations', 'search', 'sort'));
    // }



    public function index(Request $request, District $district)
    {
        // dd('helo');
        // dd($request->route()->getName());
        $search = request()->q;
        $sort = request()->sort ?? 'n';

        $month = $request->month;
        $year = $request->year;


        $placements = Placement::query()
            // ->whereHas('user', function ($q) use ($district, $search) {
            //     return $q->whereHas('basicInfo', function ($query) use ($district, $search) {
            //         return $query->where('status', 'Approved')->where('district_id', $district->id)->when(filled($search), fn ($q) => $q->where('full_name', 'LIKE', "%$search%"));
            //     });
            // })
            ->where('district_id', $district->id)
            // ->when(filled($search), fn ($q) => $q->where('full_name', 'LIKE', "%$search%"))
            ->when(filled($search), fn ($q) => $q->where('employment_no', 'LIKE', "%$search%"))
            ->when(filled($month), fn ($q) => $q->whereMonth('recruit_date', $month))
            ->when(filled($year), fn ($q) => $q->whereYear('recruit_date', $year))
            ->paginate(20)
            ->through(function (Placement $placement) {
                return [
                    // 'reg_no' => $placement->user->basicInfo->employment_no,
                    'reg_no' => $placement->employment_no,
                    'designation' => $placement->designation,
                    'recruiter' => $placement->recruiter_name,
                    'address' => $placement->address,
                    'type' => $placement->type
                ];
            });

        // $placements = Placement::query()->orderBy('created_at', 'DESC')->paginate(5);

        // dd($placements);

        $districts = District::query()->orderBy('district_code')->get(['id', 'name']);




        return view('web.placement.index', compact('placements', 'search', 'sort', 'districts', 'district'));
        // return view('web.placement.index', ['placements'=> $placements,'search'=>$search,'sort'=>$sort,'districts'=> $districts]);
    }
}
