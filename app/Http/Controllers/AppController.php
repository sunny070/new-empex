<?php

namespace App\Http\Controllers;

use App\Models\BasicInfo;
use App\Models\District;
use App\Models\JobPost;
use App\Models\NcoDivision;
use App\Models\NoticeBoard;
use App\Models\Renew;
use App\Models\UserNco;
use App\Models\Visitor;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index()
    {
        $totalUsers = BasicInfo::where('canEdit', 0)->where('status', 'Approved')->count();
        $totalMaleGender = BasicInfo::where('canEdit', 0)->where('status', 'Approved')->where('gender', 'Male')->count();
        $totalFemaleGender = BasicInfo::where('canEdit', 0)->where('status', 'Approved')->where('gender', 'Female')->count();
        $totalOtherGender = BasicInfo::where('canEdit', 0)->where('status', 'Approved')->where('gender', 'Others')->count();
        $totalAadhaarGender = BasicInfo::where('canEdit', 0)->where('status', 'Approved')->where('aadhar_no', '!=', null)->count();
        $totalNonAadhaarGender = BasicInfo::where('canEdit', 0)->where('status', 'Approved')->where('aadhar_no', null)->count();

        $totalRenewUsers = Renew::where('status', 'Approved')->count();
        $totalRenewMaleGender = Renew::where('status', 'Approved')->where('gender', 'Male')->count();
        $totalRenewFemaleGender = Renew::where('status', 'Approved')->where('gender', 'Female')->count();
        $totalRenewOtherGender = Renew::where('status', 'Approved')->where('gender', 'Others')->count();
        $totalRenewAadhaarGender = Renew::where('status', 'Approved')->where('aadhar_no', '!=', null)->count();
        $totalRenewNonAadhaarGender = Renew::where('status', 'Approved')->where('aadhar_no', null)->count();

        $totalJobs = JobPost::count();
        $totalActiveJobs = JobPost::where('due_date_of_submission', '>=', today())->count();
        $totalInactiveJobs = JobPost::where('due_date_of_submission', '<', today())->count();
        $totalPrivateJobs = JobPost::where('category_id', 1)->count();
        $totalPublicJobs = JobPost::where('category_id', 2)->count();
        $totalGovtJobs = JobPost::where('category_id', 3)->count();

        $ncoDivisions = NcoDivision::get();

        $ncoStatistics = [];

        $districts = District::query()->get(['id', 'name']);


        $allTotalUsers =  BasicInfo::query()->where('status', 'Pending')->whereNotNull('employment_no')->count();

        // foreach ($ncoDivisions as $div) {
        //     $ncoStatistics[$div->id] = (string)UserNco::where('division_id', $div->id)->withCount('user')->get()->groupBy('user_id')->count();
        // }

        $totalVisitors = Visitor::query()->count() + 5000;

        $todaysVisitors = Visitor::query()->where('visit_date',today())->count();

        $noticeboards = NoticeBoard::orderBy('created_at', 'DESC')->limit(5)->get();

        return view('web.home', compact('ncoDivisions', 'totalUsers', 'totalMaleGender', 'totalFemaleGender', 'totalOtherGender', 'totalAadhaarGender', 'totalNonAadhaarGender', 'totalRenewUsers', 'totalRenewMaleGender', 'totalRenewFemaleGender', 'totalRenewOtherGender', 'totalRenewAadhaarGender', 'totalRenewNonAadhaarGender', 'totalJobs', 'totalActiveJobs', 'totalInactiveJobs', 'totalPrivateJobs', 'totalPublicJobs', 'totalGovtJobs', 'ncoStatistics', 'noticeboards', 'allTotalUsers', 'districts','totalVisitors','todaysVisitors'));
    }

    public function getNCS()
    {
        // if (env('APP_ENV') == 'local') sleep(4);
        $ncoDivisions = NcoDivision::get();

        $ncoStatistics = [];

        foreach ($ncoDivisions as $div) {
            array_push($ncoStatistics, (string)UserNco::where('division_id', $div->id)->withCount('user')->get()->groupBy('user_id')->count());
        }
        return response()->json([
            'ncoStatistics' => (array) $ncoStatistics
        ]);
    }
}
