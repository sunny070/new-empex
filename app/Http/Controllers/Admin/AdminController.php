<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\NotifySMSJob;
use App\Models\Admin;
use App\Models\BasicInfo;
use App\Models\ChangeAddress;
use App\Models\Department;
use App\Models\JobPost;
use App\Models\News;
use App\Models\OnGoingApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AdminController extends Controller
{
    public function adminIndex()
    {
        if (auth()->guard('admin')->user()->role_id != 1) {
            if (auth()->guard('admin')->user()->role_id == 2) {
                return redirect(route('verifier.dashboard'));
            } elseif (auth()->guard('admin')->user()->role_id == 3) {
                return redirect(route('approver.dashboard'));
            } else {
                return redirect(route('employer.dashboard'));
            }
        }

        $pendingVerification = BasicInfo::where('canEdit', 0)->where('status', 'Pending')->count();
        $pendingApproval = BasicInfo::where('canEdit', 0)->where('status', 'Verified')->count();
        $pendingEmployer = Admin::where('role_id', 4)->where('is_approved', 0)->count();
        $noOfJobs = JobPost::count();

        // total news from previous 7 days
        $prev = date('Y-m-d H:i:s', strtotime('-7 day', strtotime(now())));
        // $noOfNews = News::whereBetween('created_at', [$prev, now()])->count();

        $noOfNews = News::count();

        $users = BasicInfo::where('canEdit', 0)->where('status', 'Approved')->count();
        $admins = Admin::where('role_id', '!=', 4)->where('is_approved', 1)->count();

        $totalDepartments = Department::count();

        // change requests
        $pendingChangeVerification = OnGoingApplication::where('type', 'LIKE', 'Change request%')->where('status', 'Pending')->count();
        //added by rj
        $pendingChangeVerification = OnGoingApplication::where('type', 'LIKE', 'Change request%')->where('status', 'Pending')->distinct('user_id')->count();
        //added by rj
        $pendingChangeApproval = OnGoingApplication::where('type', 'LIKE', 'Change request%')->where('status', 'Verified')->count();

        return view('admin.dashboard', compact('pendingVerification', 'pendingApproval', 'pendingEmployer', 'noOfJobs', 'noOfNews', 'users', 'admins', 'pendingChangeVerification', 'pendingChangeApproval', 'totalDepartments'));
    }

    public function getMiscellaneous()
    {
        if (auth()->guard('admin')->user()->role_id != 1) {
            abort(401);
        }

        return view('admin.adminControls.miscellaneous');
    }

    public function getAddresses()
    {
        if (auth()->guard('admin')->user()->role_id != 1) {
            abort(401);
        }

        return view('admin.adminControls.address');
    }

    public function adminControls()
    {
        if (auth()->guard('admin')->user()->role_id != 1) {
            abort(401);
        }

        return view('admin.controls.address');
    }

    public function adminDepartments()
    {
        if (auth()->guard('admin')->user()->role_id != 1) {
            abort(401);
        }

        return view('admin.controls.departments');
    }

    public function adminLanguages()
    {
        if (auth()->guard('admin')->user()->role_id != 1) {
            abort(401);
        }

        return view('admin.controls.languages');
    }

    public function adminChallenges()
    {
        if (auth()->guard('admin')->user()->role_id != 1) {
            abort(401);
        }

        return view('admin.controls.challenges');
    }

    public function adminEducation()
    {
        if (auth()->guard('admin')->user()->role_id != 1) {
            abort(401);
        }

        return view('admin.controls.education');
    }

    public function adminNco()
    {
        if (auth()->guard('admin')->user()->role_id != 1) {
            abort(401);
        }

        return view('admin.controls.nco');
    }

    public function adminOrganization()
    {
        if (auth()->guard('admin')->user()->role_id != 1) {
            abort(401);
        }

        return view('admin.controls.organization');
    }

    public function adminTerms()
    {
        if (auth()->guard('admin')->user()->role_id != 1) {
            abort(401);
        }

        return view('admin.controls.terms');
    }

    public function registeringAuthority()
    {
        if (auth()->guard('admin')->user()->role_id != 1) {
            abort(401);
        }

        return view('admin.controls.authority');
    }



    public function sendNewRegistrationSMS()
    {

        if (auth()->guard('admin')->user()->role_id != 1) {
            abort(401);
        }

        // $data = BasicInfo::query()->where('notify_sms', 'yes')->get();
        // dd($data);
        // NotifySMSJob::dispatch($data);
        // dispatch(new NotifySMSJob());


        BasicInfo::query()->where('notify_sms', 'yess')->chunk(2, function ($nos) {
            $contacts = collect($nos->pluck('phone_no'))->toArray();
            $ids = collect($nos->pluck('id'))->toArray();
            $strContacts = implode(",", $contacts);

            // info($strContacts);

            // $response = Http::withHeaders([
            //     'Authorization' => "Bearer " . env('SMS_TOKEN'),
            // ])->get("https://sms.msegs.in/api/send-sms", [
            //     'template_id' => "1407167868305358074",
            //     // 'message' => "Your empex new registration card is generated. Kindly download from https://empex.mizoram.gov.in/auth/employee/enrollment-card -EMPEX",
            //     'message' => "Your empex new registration card is generated. Kindly download from empex.mizoram.gov.in -EMPEX",
            //     // 'message' => "Your empex new registration card is generated. Kindly download from \$url -EMPEX",
            //     'recipient' => "$strContacts"
            // ]);

            // if (1) {
            info($ids);
            // BasicInfo::query()->whereIn('id', $ids)->update([
            //     'notify_sms' => 'notified'
            // ]);
            // }

            // info('http res: ' . $response->body());
        });





        return response()->json([
            'message' => 'SMS Notified'
        ]);
    }
    public function getNotice()
    {
        if (auth()->guard('admin')->user()->role_id != 1) {
            abort(401);
        }

        return view('admin.notice');
    }
}
