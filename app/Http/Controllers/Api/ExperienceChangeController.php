<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\SendStatusSms;
use App\Models\BasicInfo;
use App\Models\ChangeExperience;
use App\Models\OnGoingApplication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ExperienceChangeController extends Controller
{
  public function checkChangeExperience($id)
  {
    $check = ChangeExperience::where('user_id', $id)->first();
    if ($check != null) {
      return response()->json(200);
    }
    return response()->noContent();
  }

  public function changeExperience(Request $request)
  {
    Log::info($request->all());
    $experiences = json_decode($request->experiences, true);
    $user = User::findOrFail($request->user_id);
    ChangeExperience::where('user_id', $request->user_id)->delete();
    foreach ($experiences as $experience) {
      $createExperience = new ChangeExperience;
      $createExperience->user_id = $request->user_id;
      $createExperience->designation = $experience['designation'];
      $createExperience->from = $experience['from'];
      $createExperience->to = $experience['to'] != "" ? $experience['to'] : null;
      $createExperience->company = $experience['company'];
      $createExperience->total_emoluments = $experience['total_emoluments'];
      $createExperience->leave_reason = $experience['leave_reason'];
      $createExperience->is_working = $experience['is_working'] == 'true' ? 1 : 0;
      $createExperience->user_district_id = BasicInfo::where('user_id', $request->user_id)->value('district_id');
      $createExperience->save();
    }

    $ongoing = new OnGoingApplication();
    $ongoing->user_id = $request->user_id;
    $ongoing->type = 'Change request - Experiences';
    $ongoing->model_name = 'Experience';
    $ongoing->requested_id = $createExperience->id;
    $ongoing->status = 'Pending';
    $ongoing->color = '#ff7e0e';
    $ongoing->bg = '#fff5ef';
    $ongoing->save();

    SendStatusSms::dispatch($user->phone_no, 'change experience', 'received')->delay(30);
    return response()->json(['success' => 'Application for changing Experience has been submitted']);
  }
}
