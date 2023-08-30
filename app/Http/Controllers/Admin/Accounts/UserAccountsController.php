<?php

namespace App\Http\Controllers\Admin\Accounts;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\BasicInfo;
use App\Models\EducationQualification;
use App\Models\Experience;
use App\Models\NcoDetail;
use App\Models\User;
use App\Models\UserCanRead;
use App\Models\UserCanSpeak;
use App\Models\UserCanWrite;
use App\Models\UserNco;
use App\Models\UserPhysicalChallenge;
use Illuminate\Http\Request;

class UserAccountsController extends Controller
{
  public function getUserAccounts()
  {
    if (auth()->guard('admin')->user()->role_id != 1) {
      abort(401);
    }

    return view('admin.accounts.userAccount');
  }
  public function getExpiredAccounts()
  {
    if (auth()->guard('admin')->user()->role_id != 1) {
      abort(401);
    }

    return view('admin.accounts.expiredAccount');
  }

  public function getUserDetail($id)
  {
    if (auth()->guard('admin')->user()->role_id != 1) {
      abort(401);
    }

    $basicInfo = BasicInfo::where('id', $id)->where('canEdit', 0)->firstOrFail();
    $addresses = Address::with('state', 'district', 'rdBlock', 'policeStation', 'postOffice')->where('user_id', $basicInfo->user_id)->get();
    $qualifications = EducationQualification::with('qualification', 'subject', 'majorCore')->where('user_id', $basicInfo->user_id)->get();
    $experiences = Experience::where('user_id', $basicInfo->user_id)->get();
    $authPreferNcoCode = UserNco::where('user_id', $basicInfo->user_id)->where('nco_code_display', '!=', null)->value('nco_code_display');
    $ncoCodeToDisplay = NcoDetail::where('id', $authPreferNcoCode)->first();
    $ncoFamilySelected = UserNco::with('family', 'detail')->has('detail')->where('user_id', $basicInfo->user_id)->orderBy('family_id', 'ASC')->get()->groupBy('family.name')->toArray();
    $readLang = UserCanRead::with('language')->where('user_id', $basicInfo->user_id)->get();
    $writeLang = UserCanWrite::with('language')->where('user_id', $basicInfo->user_id)->get();
    $spokenLang = UserCanSpeak::with('language')->where('user_id', $basicInfo->user_id)->get();
    $physicalList = UserPhysicalChallenge::with('physicalChallenge')->where('user_id', $basicInfo->user_id)->get();

    $langRead = '';
    $langWrite = '';
    $langSpoken = '';
    $physical = '';

    foreach ($readLang as $read) {
      $langRead .= $read->language->name;
      if ($readLang->last() != $read) {
        $langRead .= ', ';
      }
    }

    foreach ($writeLang as $write) {
      $langWrite .= $write->language->name;
      if ($writeLang->last() != $write) {
        $langWrite .= ', ';
      }
    }

    foreach ($spokenLang as $spoken) {
      $langSpoken .= $spoken->language->name;
      if ($spokenLang->last() != $spoken) {
        $langSpoken .= ', ';
      }
    }

    foreach ($physicalList as $challenge) {
      $physical .= $challenge->physicalChallenge->name;
      if ($physicalList->last() != $challenge) {
        $physical .= ', ';
      }
    }

    return view('admin.accounts.employeeDetail', compact('basicInfo', 'addresses', 'qualifications', 'experiences', 'langRead', 'langWrite', 'langSpoken', 'physical', 'ncoCodeToDisplay', 'ncoFamilySelected'));
  }
}
