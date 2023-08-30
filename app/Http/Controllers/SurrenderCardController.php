<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\BasicInfo;
use App\Models\EducationQualification;
use App\Models\Experience;
use App\Models\UserCanRead;
use App\Models\UserCanSpeak;
use App\Models\UserCanWrite;
use App\Models\UserJob;
use App\Models\UserNco;
use App\Models\UserPhysicalChallenge;
use Illuminate\Http\Request;

class SurrenderCardController extends Controller
{
  public function surrenderCard(Request $request)
  {
    $userId = $request->user_id;
    BasicInfo::where('user_id', $userId)->delete();
    Address::where('user_id', $userId)->delete();
    EducationQualification::where('user_id', $userId)->delete();
    Experience::where('user_id', $userId)->delete();
    UserCanRead::where('user_id', $userId)->delete();
    UserCanSpeak::where('user_id', $userId)->delete();
    UserCanWrite::where('user_id', $userId)->delete();
    UserJob::where('user_id', $userId)->delete();
    UserNco::where('user_id', $userId)->delete();
    UserPhysicalChallenge::where('user_id', $userId)->delete();
  }
}
