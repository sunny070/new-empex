<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Department;
use App\Models\District;
use App\Models\JobPost;
use App\Models\Placement;
use App\Models\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PlacementController extends Controller
{


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




        return view('admin.placement.index', compact('placements', 'search', 'sort', 'districts', 'district'));
        // return view('web.placement.index', ['placements'=> $placements,'search'=>$search,'sort'=>$sort,'districts'=> $districts]);
    }

    public function getPlacement()
    {
        if (auth()->guard('admin')->user()->role_id != 1) {
            abort(401);
        }

        $jobs = JobPost::where('published', 1)->orderBy('created_at', 'desc')->paginate();
        $unpublished = JobPost::where('published', 0)->count();
        return view('admin.placement', compact('jobs', 'unpublished'));
    }

    public function createPlacement()
    {
        if (auth()->guard('admin')->user()->role_id != 1) {
            abort(401);
        }

        return view('admin.createPlacement');
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
