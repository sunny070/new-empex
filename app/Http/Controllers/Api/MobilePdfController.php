<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\BasicInfo;
use App\Models\EducationQualification;
use App\Models\Experience;
use App\Models\NcoDetail;
use App\Models\RegisteringAuthority;
use App\Models\RegisteringAuthorityDistrict;
use App\Models\UserCanRead;
use App\Models\UserCanSpeak;
use App\Models\UserCanWrite;
use App\Models\UserNco;
use App\Models\UserPhysicalChallenge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use PDF;

class MobilePdfController extends Controller
{
  public function downloadA4(Request $request)
  {
      $langRead = null;
      $langWrite = null;
      $langSpoken = null;
      $disable = null;

      // $info = BasicInfo::with('religion')->where('user_id', auth()->id())->first();


      $info = BasicInfo::where('user_id', auth()->id())->where('status', 'Approved')->latest('card_valid_till')->first();


      $permanent = Address::with('state', 'district', 'rdBlock', 'policeStation', 'postOffice')->where('user_id', auth()->id())->where('type', 'permanent')->first();

      $present = Address::with('state', 'district', 'rdBlock', 'policeStation', 'postOffice')->where('user_id', auth()->id())->where('type', 'present')->first();

      $educations = EducationQualification::with('qualification', 'subject', 'majorCore')->where('user_id', auth()->id())->get();

      $experiences = Experience::where('user_id', auth()->id())->get();

      // user read language
      $readLang = UserCanRead::with('language')->where('user_id', auth()->id())->get();
      foreach ($readLang as $read) {
          $langRead .= $read->language->name;
          if ($readLang->last() != $read) {
              $langRead .= ', ';
          }
      }

      // user write language
      $writeLang = UserCanWrite::with('language')->where('user_id', auth()->id())->get();
      foreach ($writeLang as $write) {
          $langWrite .= $write->language->name;
          if ($writeLang->last() != $write) {
              $langWrite .= ', ';
          }
      }

      // user spoken language
      $spokenLang = UserCanSpeak::with('language')->where('user_id', auth()->id())->get();
      foreach ($spokenLang as $spoken) {
          $langSpoken .= $spoken->language->name;
          if ($spokenLang->last() != $spoken) {
              $langSpoken .= ', ';
          }
      }

      // user physical disable
      $userPhysicalList = UserPhysicalChallenge::with('physicalChallenge')->where('user_id', auth()->id())->get();
      foreach ($userPhysicalList as $challenge) {
          $disable .= $challenge->physicalChallenge->name;
          if ($userPhysicalList->last() != $challenge) {
              $disable .= ', ';
          }
      }

      $authPreferNcoCode = UserNco::where('user_id', auth()->id())->where('nco_code_display', '!=', null)->value('nco_code_display');
      $ncoCodeToDisplay = NcoDetail::where('id', $authPreferNcoCode)->value('code');

      $authorityDistrict = RegisteringAuthorityDistrict::where('district_id', $info->district_id)->value('registering_authority_id');

      $signature = RegisteringAuthority::where('id', $authorityDistrict)->first();




      $image = QrCode::format('svg')
          ->generate(route('qr-code', [
              $info->phone_no,
              $info->employment_no,
          ]));
      $path = "images/qr/$info->employment_no.svg";
      $info->qr = $path;


      Storage::disk('public')->put($path, $image);

      $pdf = PDF::loadView('web.auth.pdf.a4', compact('info', 'langRead', 'langWrite', 'langSpoken', 'permanent', 'present', 'educations', 'experiences', 'disable', 'ncoCodeToDisplay', 'signature'));
      return $pdf->stream($info->employment_no . '_empex_card.pdf');
  }

  public function downloadCard(Request $request)
  {
    $userId = $request->user_id;
      $info = BasicInfo::where('user_id', auth()->id())->where('status', 'Approved')->latest('card_valid_till')->first();
      $basicInfo = BasicInfo::where('user_id', auth()->id())->where('status', 'Approved')->latest('card_valid_till')->first();

      $permanent = Address::with('district:id,name')->where('user_id', $basicInfo->user_id)->where('type', 'permanent')->first();
      $authPreferNcoCode = UserNco::where('user_id', $basicInfo->user_id)->where('nco_code_display', '!=', null)->value('nco_code_display');
      $ncoCodeToDisplay = NcoDetail::where('id', $authPreferNcoCode)->value('code');
      $customPaper = array(0, 0, 245.00, 310.80);
      $authorityDistrict = RegisteringAuthorityDistrict::where('district_id', $info->district_id)->value('registering_authority_id');
      $signature = RegisteringAuthority::where('id', $authorityDistrict)->first();


      $image = QrCode::format('svg')
          ->generate(route('qr-code', [
              $basicInfo->phone_no,
              $basicInfo->employment_no,
          ]));
      $path = "images/qr/$basicInfo->employment_no.svg";
      $basicInfo->qr = $path;


      Storage::disk('public')->put($path, $image);

      $pdf = PDF::loadView('web.auth.pdf.card', compact('info', 'permanent', 'ncoCodeToDisplay', 'signature'))->setPaper($customPaper, 'landscape');

      Storage::disk('public')->put('employment_card/' . $info->employment_no . '_empex_pocket_card.pdf', $pdf->output());

      //added by rj



      return Storage::download('public/employment_card/' . $info->employment_no . '_empex_pocket_card.pdf');

//    $info = BasicInfo::where('user_id', $userId)->first();
//    $ncoInfo = UserNco::firstWhere(['user_id' => $userId]);
//    $ncoDetails = NcoDetail::firstWhere(['nco_family_id' => $ncoInfo->nco_code_display]);
//    $authorityDistrict = RegisteringAuthorityDistrict::where('district_id', $info->district_id)->value('registering_authority_id');
//
//    $signature = RegisteringAuthority::where('id', $authorityDistrict)->first();
//    $permanent = Address::with('district:id,name')->where('user_id', $userId)->where('type', 'permanent')->first();
//      $qrcode = base64_encode(
//          QrCode::size(70)->margin(1)->generate(
//              route('qr-code', [
//                  'phone' => $info->phone_no,
//                  'empNo' => $info->employment_no,
//              ])
//          )
//      );
//
//
//      $pdf = PDF::loadView('web.auth.pdf.card', compact('info', 'permanent', 'qrcode', 'ncoDetails', 'signature'));
//      info($pdf);
//    return $pdf->download($info->full_name . '_empex_pocket_card.pdf');
  }
}
