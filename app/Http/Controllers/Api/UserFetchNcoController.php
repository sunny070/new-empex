<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\SendStatusSms;
use App\Models\BasicInfo;
use App\Models\NcoDetail;
use App\Models\NcoDivision;
use App\Models\NcoFamily;
use App\Models\NcoGroup;
use App\Models\NcoSubDivision;
use App\Models\OnGoingApplication;
use App\Models\UserNco;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class UserFetchNcoController extends Controller
{
  public function getDivision()
  {
    $divisions = NcoDivision::get();
    return response()->json(['divisions' => $divisions]);
  }

  public function getGroup($divId)
  {
    $groups = NcoGroup::where('nco_division_id', $divId)->get();
    return response()->json(['groups' => $groups]);
  }

  public function getFamily($groupId)
  {
    $families = NcoFamily::where('nco_group_id', $groupId)->get();
    return response()->json(['families' => $families]);
  }

  public function getDetails(Request $request)
  {
    $nco_family = $request->nco_family;
    $nco_family = explode("[(", $nco_family)[1];
    $nco_family = explode(")]", $nco_family)[0];
    $nco_family = explode(",", $nco_family);

    $family = NcoFamily::whereIn('id', $nco_family)->with('ncoDetail')->get();
    return response()->json(['family' => $family]);
  }

  public function userAddNco(Request $request)
  {

    $nco_detail = $request->nco_details;
    $nco_detail = explode("[", $nco_detail)[1];
    $nco_detail = explode("]", $nco_detail)[0];
    $nco_detail = explode(",", $nco_detail);
    UserNco::where('user_id', $request->user_id)->delete();
    foreach ($nco_detail as $detail) {
      $ncoDetail = NcoDetail::findOrFail($detail);
      $ncoFamily = NcoFamily::findOrFail($ncoDetail->nco_family_id);
      $ncoGroup = NcoGroup::findOrFail($ncoFamily->nco_group_id);
      $ncoSubDivision = NcoSubDivision::findOrFail($ncoGroup->nco_sub_division_id);
      $ncoDivision = NcoDivision::findOrFail($ncoSubDivision->nco_division_id);

      $userNco = new UserNco;
      $userNco->user_id = $request->user_id;
      $userNco->division_id = $ncoDivision->id;
      $userNco->sub_division_id = $ncoSubDivision->id;
      $userNco->group_id = $ncoGroup->id;
      $userNco->family_id = $ncoFamily->id;
      $userNco->detail_id = $detail;
      $userNco->save();
    }

    return response()->json(['success' => 'NCO Saved']);
  }

  public function getMyNco($id)
  {
    $userNco = UserNco::where('user_id', $id)->get()->pluck('detail_id');
    $ncoDetails = NcoDetail::whereIn('id', $userNco)->first();

    return response()->json(['ncoDetails' => $ncoDetails]);
  }

  public function setDisplayNco(Request $request)
  {
    Log::info($request->all());
    try {
      $userNco = UserNco::where('user_id', $request->user_id)->where('detail_id', $request->detail_id)->first();
      $userNco->nco_code_display = 1;
      $userNco->save();

      $user = BasicInfo::where('user_id', $request->user_id)->first();
      $user->canEdit = 0;
      $user->percent_complete = 100;
      $user->save();

      $onGoing = OnGoingApplication::firstOrNew(
        ['user_id' => $request->user_id],
        ['type' => 'New Application'],
      );
      $onGoing->user_id = $request->user_id;
      $onGoing->type = 'New Application';
      $onGoing->model_name = 'BasicInfo';
      $onGoing->requested_id = $user->id;
      $onGoing->status = 'Pending';
      $onGoing->color = '#2d9735';
      $onGoing->bg = '#e1ffe3';
      $onGoing->save();
    } catch (Throwable $err) {
      Log::info($err);
      return response()->json(['error' => 'Something Went Wrong'], 205);
    }

    SendStatusSms::dispatch($user->phone_no, 'apply for employment card', 'received')->delay(30);
    return response()->json(['success' => 'User NCO display saved']);
  }
}
