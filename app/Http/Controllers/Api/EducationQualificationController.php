<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BasicInfo;
use App\Models\EducationQualification;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Throwable;

class EducationQualificationController extends Controller
{
  public function createQualification(Request $request)
  {
    $qualifications = json_decode($request->qualifications, true);
    $existing_educations = EducationQualification::where('user_id', $request->user_id)->get();
    try {
      foreach ($qualifications as $qualification) {
        if ($qualification['qualification_certificate'] != '') {
          $file = $this->storeImage('certificate', $qualification['qualification_certificate']);
        } else {
          $file = $qualification['certificate'];
        }

        $qualifications = new EducationQualification;
        $qualifications->user_id = $request->user_id;
        $qualifications->qualification_id = $qualification['qualification_id'];
        $qualifications->school = $qualification['school'];
        $qualifications->subject_id = $qualification['subject_id'];
        $qualifications->major_core_id = $qualification['major_core_id'];
        $qualifications->year_of_passing = strval($qualification['year_of_passing']);
        $qualifications->certificate = $file;
        $qualifications->division = $qualification['division'];
        $qualifications->course_duration = $qualification['course_duration'];
        $qualifications->save();
      }
      if (count($existing_educations) != 0) {
        foreach ($existing_educations as $education) {
          $education->delete();
        }
      }

      $basicInfo = BasicInfo::where('user_id', $request->user_id)->first();
      $basicInfo->percent_complete = 60;
      $basicInfo->save();

      return response()->json(['success' => 'Education Qualification Created Successfully']);
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

  public function getMyQualifications(Request $request)
  {
    $qualifications = EducationQualification::where('user_id', $request->user_id)->with('qualification', 'subject', 'majorCore')->get();
    if (count($qualifications) == 0) {
      return response()->noContent();
    }
    return response()->json(['qualifications' => $qualifications]);
  }
}
