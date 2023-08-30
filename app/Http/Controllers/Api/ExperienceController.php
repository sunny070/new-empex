<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BasicInfo;
use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ExperienceController extends Controller
{
  public function createExperience(Request $request)
  {
    $experiences = json_decode($request->experiences, true);
    $user = BasicInfo::where('user_id', $request->user_id)->first();
    $user->percent_complete = 80;
    $user->save();

    Log::info($experiences);

    if (Experience::where('user_id', $request->user_id)->count() != 0) {
      Experience::where('user_id', $request->user_id)->delete();
    }
    foreach ($experiences as $experience) {
      if ($experience['designation'] != '') {
        $createExperience = new Experience;
        $createExperience->user_id = $request->user_id;
        $createExperience->designation = $experience['designation'];
        $createExperience->from = $experience['from'];
        $createExperience->to = $experience['to'] != "" ? $experience['to'] : null;
        $createExperience->company = $experience['company'];
        $createExperience->total_emoluments = $experience['total_emoluments'];
        $createExperience->leave_reason = $experience['leave_reason'];
        $createExperience->is_working = $experience['is_working'] == 'true' ? 1 : 0;
        $createExperience->save();
      }
    }

    return response()->json(['success' => 'Experience Added']);
  }

  public function getMyExperience(Request $request)
  {
    $experiences = Experience::where('user_id', $request->user_id)->get();
    if (count($experiences) == 0) {
      return response()->noContent();
    }
    return response()->json(['experiences' => $experiences]);
  }
}
