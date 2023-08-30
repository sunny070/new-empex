<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\BasicInfo;
use App\Models\ChangeAddress;
use App\Models\ChangeBasicInfo;
use App\Models\ChangeEducation;
use App\Models\ChangeExperience;
use App\Models\ChangeNco;
use App\Models\ChangeUserCanRead;
use App\Models\ChangeUserCanSpeak;
use App\Models\ChangeUserCanWrite;
use App\Models\ChangeUserPhysicalChallenge;
use App\Models\EducationQualification;
use App\Models\Experience;
use App\Models\JobPost;
use App\Models\News;
use App\Models\OnGoingApplication;
use App\Models\Renew;
use App\Models\SponsoredNotification;
use App\Models\Transfer;
use App\Models\User;
use App\Models\UserCanRead;
use App\Models\UserCanSpeak;
use App\Models\UserCanWrite;
use App\Models\UserJob;
use App\Models\UserNco;
use App\Models\UserPhysicalChallenge;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
  public function index()
  {
    info('userid'.auth()->user()->id);


    $percent = 0;
    $cardValidTill = null;
    $registrationCard = false;
    $completedProfile = false;
    $totalJobs = JobPost::count();
    $employmentNo = null;
    $totalOngoingApplication = OnGoingApplication::where('user_id', auth()->id())->count();
    $jobList = JobPost::take(3)->get();
    $newsList = News::take(3)->get();
    $userName = auth()->user()->name;

    $basicInfo = BasicInfo::where('user_id', auth()->id())->latest('updated_at')->first();
    if ($basicInfo) {
      if ($basicInfo->canEdit == 0 && $basicInfo->status == 'Approved') {
        $registrationCard = true;
        $cardValidTill = $basicInfo->card_valid_till;
        $userName = $basicInfo->full_name;
        $employmentNo = $basicInfo->employment_no;
      }

      $percent = $basicInfo->percent_complete;
      if ($basicInfo->percent_complete == '100') {
        $completedProfile = true;
      }
    }

    $noti = SponsoredNotification::where('user_id', auth()->id())->where('is_read', 0)->count();

    return view('web.auth.dashboard', compact('jobList', 'newsList', 'totalJobs', 'percent', 'registrationCard', 'completedProfile', 'totalOngoingApplication', 'cardValidTill', 'userName', 'employmentNo', 'noti'));
  }

  public function enrollmentCard()
  {
    $userCard = BasicInfo::where('user_id', auth()->id())->where('canEdit', 0)->where('status', 'Approved')->latest('card_valid_till')->first();
    if (!$userCard) {
      return redirect(route('auth.dashboard'))->with('message', 'Enrollment Card not ready!');
    }
    return view('web.auth.enrollmentCard');
  }

  public function renewEnrollment()
  {
    $info = BasicInfo::where('user_id', auth()->id())->where('canEdit', 0)->where('status', 'Approved')->latest('card_valid_till')->first();

    if (!$info) {
      return redirect(route('auth.dashboard'))->with('message', 'Application not approved!');
    }

    $enableButton = false;
    $gracePeriodOver = false;
    $periodOverMsg = '';
    $expired = false;
    $renewalDays = '';
    $enableDate = date('Y-m-d', strtotime($info->card_valid_till . ' -2 month'));

    // dd($enableDate);

    $validDate = Carbon::parse($info->card_valid_till);

    $result = now()->diffInDays($validDate, false);
    // $renewalDays = $validDate->addMonths(3)->diffInDays(now(), false)+1;
    $renewalDays = now()->diffInDays($validDate->addMonths(3), false) + 1;

    // dd($validDate->format('d') );
    $renewalDays = now()->format('d') == $validDate->format('d') ? 0 : $renewalDays;




    $s = '';
    if ($result < 0) {
      $daysLeft = '<span class="text-empex-red">Expired</span>';
      $expired = true;
    } else {
      if ($result >= 10) {
        $s = 's';
      }
      $daysLeft = '<span>' . $result . ' Day' . $s . '</span>';
    }

    if (date('Y-m-d') >= $enableDate) {
      $enableButton = true;
    }

    $alreadyRenew = Renew::where('user_id', auth()->id())->where('status', 'Pending')->first();



    //added rj
    $basic = BasicInfo::query()
      ->where('user_id', auth()->id())
      ->whereDate('card_valid_till', '<', now())
      ->where('status', 'Approved')
      ->latest('card_valid_till')

      ->first();

    if ($basic) {

      $this_month = Carbon::parse($basic->card_valid_till); // returns 2019-07-01
      $validDay = Carbon::parse($basic->card_valid_till)->format('d');
      $start_month = Carbon::parse(now()); // returns 2019-06-01

      if (($start_month->floatDiffInRealMonths($this_month)  >= 3)) {
        $gracePeriodOver = true;
        $periodOverMsg = '<span class="text-empex-red">Your Renewal Grace period is over. Kindly Register again</span>';
      } else {
        $enableButton = true;
      }
    }

    //added rj

    return view('web.auth.renew', compact('info', 'enableButton', 'daysLeft', 'enableDate', 'alreadyRenew', 'gracePeriodOver', 'periodOverMsg', 'expired', 'renewalDays'));
  }

  public function ongoingApplication()
  {
    $applications = OnGoingApplication::where('user_id', auth()->id())->with('user:id,name')->orderBy('created_at', 'DESC')->paginate(5);
    return view('web.auth.status', compact('applications'));
  }

  public function removeOngoing($id)
  {
    ongoingApplication::findOrFail($id)->delete();
    return back();
  }

  public function surrender()
  {
    $info = BasicInfo::where('user_id', auth()->id())->first();

    if (!$info || $info->status != 'Approved') {
      return redirect(route('auth.dashboard'))->with('message', 'Application not approved!');
    }

    return view('web.auth.surrender');
  }

  public function employeeSurrender()
  {
    BasicInfo::where('user_id', auth()->id())->delete();
    Address::where('user_id', auth()->id())->delete();
    EducationQualification::where('user_id', auth()->id())->delete();
    Experience::where('user_id', auth()->id())->delete();
    UserPhysicalChallenge::where('user_id', auth()->id())->delete();
    UserCanSpeak::where('user_id', auth()->id())->delete();
    UserCanRead::where('user_id', auth()->id())->delete();
    UserCanWrite::where('user_id', auth()->id())->delete();
    UserJob::where('user_id', auth()->id())->delete();
    OnGoingApplication::where('user_id', auth()->id())->delete();
    UserNco::where('user_id', auth()->id())->delete();
    Transfer::where('user_id', auth()->id())->delete();
    Renew::where('user_id', auth()->id())->delete();

    ChangeBasicInfo::where('user_id', auth()->id())->delete();
    ChangeAddress::where('user_id', auth()->id())->delete();
    ChangeEducation::where('user_id', auth()->id())->delete();
    ChangeExperience::where('user_id', auth()->id())->delete();
    ChangeUserCanRead::where('user_id', auth()->id())->delete();
    ChangeUserCanSpeak::where('user_id', auth()->id())->delete();
    ChangeUserCanWrite::where('user_id', auth()->id())->delete();
    ChangeUserPhysicalChallenge::where('user_id', auth()->id())->delete();
    ChangeNco::where('user_id', auth()->id())->delete();

    User::where('id', auth()->id())->delete();
    return redirect(route('web.home'));
  }

  public function notiDetail($id)
  {
    $noti = SponsoredNotification::findOrFail($id);
    $noti->is_read = 1;
    $noti->save();

    return view('web.auth.notification-detail', compact('noti'));
  }
}
