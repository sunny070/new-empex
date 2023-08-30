<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AdminDistrict;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function getTotalRegistration()
    {
        if (auth()->guard('admin')->user()->role_id != 1) {
            abort(401);
        }

        return view('admin.reports.totalRegistrationReport');
    }

    public function getRegisteredUser()
    {
        if (auth()->guard('admin')->user()->role_id != 1) {
            abort(401);
        }

        return view('admin.reports.registered-user');
    }
    public function getEdistrictUser()
    {
        if (auth()->guard('admin')->user()->role_id != 1) {
            abort(401);
        }

        // return Admin::query()->whereHas('district')->with(['district' => function($query){
        //     $query->select('admin_districts.id','name');
        // }])->get()->pluck('district');


        return view('admin.reports.edistrict-user');
    }

    public function getSponsorship()
    {
        if (auth()->guard('admin')->user()->role_id != 1 && auth()->guard('admin')->user()->role_id != 5) {
            abort(401);
        }

        return view(auth()->guard('admin')->user()->role_id == 1 ? 'admin.reports.sponsorship' : 'district-admin.reports.sponsorship');
    }

    public function getSponsorshipList()
    {
        if (auth()->guard('admin')->user()->role_id != 1 && auth()->guard('admin')->user()->role_id != 5) {
            abort(401);
        }

        return view(auth()->guard('admin')->user()->role_id == 1 ? 'admin.reports.sponsorship-list' : 'district-admin.reports.sponsorship-list');
    }
}
