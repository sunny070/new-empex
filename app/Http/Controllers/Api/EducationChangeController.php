<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\SendStatusSms;
use App\Models\BasicInfo;
use App\Models\ChangeEducation;
use App\Models\OnGoingApplication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Throwable;

class EducationChangeController extends Controller
{
  public function checkChangeAddress($id)
  {
    $check = ChangeEducation::where('user_id', $id)->first();
    if ($check != null) {
      return response()->json(200);
    }
    return response()->noContent();
  }

  public function changeEducation(Request $request)
  {
    Log::info($request->all());
    $user = User::findOrFail($request->user_id);
    $qualifications = json_decode($request->qualifications, true);
    $existing_educations = ChangeEducation::where('user_id', $request->user_id)->get();
    try {
      foreach ($qualifications as $qualification) {
        if ($qualification['qualification_certificate'] != null) {
          $file = $this->storeImage('certificate', $qualification['qualification_certificate']);
        } else {
          $file = $qualification['certificate'];
        }
        $changeQualification = new ChangeEducation;
        $changeQualification->user_id = $request->user_id;
        $changeQualification->qualification_id = $qualification['qualification_id'];
        $changeQualification->school = $qualification['school'];
        $changeQualification->subject_id = $qualification['subject_id'];
        $changeQualification->major_core_id = $qualification['major_core_id'];
        $changeQualification->year_of_passing = strval($qualification['year_of_passing']);
        $changeQualification->certificate = $file;
        $changeQualification->division = $qualification['division'];
        $changeQualification->course_duration = $qualification['course_duration'];
        $changeQualification->user_district_id = BasicInfo::where('user_id', $request->user_id)->value('district_id');
        $changeQualification->save();
      }
      if (count($existing_educations) != 0) {
        foreach ($existing_educations as $education) {
          $education->delete();
        }
      }

      $ongoing = new OnGoingApplication();
      $ongoing->user_id = $request->user_id;
      $ongoing->type = 'Change request - Education details';
      $ongoing->model_name = 'ChangeEducation';
      $ongoing->requested_id = $changeQualification->id;
      $ongoing->status = 'Pending';
      $ongoing->color = '#ff7e0e';
      $ongoing->bg = '#fff5ef';
      $ongoing->save();

      SendStatusSms::dispatch($user->phone_no, 'change educational details', 'received')->delay(30);
      return response()->json(['success' => 'Change Reuquest For Education Qualification Submitted Successfully']);
    } catch (Throwable $ex) {
      report($ex);
      return response()->json(['error' => 'Failed to insert education qualification'], 205);
    }
  }

  public function storeImage($path, $base64Image)
  {
    $image_64 = $base64Image;
    $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];
    $image = substr($image_64, strpos($image_64, ',') + 1);
    $imageName = Str::random(30) . date('YmdHis') . '.' . $extension;
    $pathUrl = $path . '/' . $imageName;
    Storage::disk('public')->put($pathUrl, base64_decode($image), 'public');
    return $pathUrl;
  }
}
