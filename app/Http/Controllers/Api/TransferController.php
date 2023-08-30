<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BasicInfo;
use App\Models\Transfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class TransferController extends Controller
{
  public function submitTransfer(Request $request)
  {
    try {
      $presentAddress = new Transfer;
      $presentAddress->user_id = $request->user_id;
      $presentAddress->state_id = $request->state_id;
      $presentAddress->district_id = $request->district_id;
      $presentAddress->village_id = $request->village_id;
      $presentAddress->pin_code = $request->pin_code_id;
      $presentAddress->house_no = $request->house_no;
      $presentAddress->user_district_id = BasicInfo::where('user_id', $request->user_id)->value('district_id');
      $presentAddress->save();
    } catch (Throwable $ex) {
      report($ex);
      Log::info($ex);
      return response()->json(['error' => 'Oops! Something went wrong'], 205);
    }
    return response()->json(['success' => 'Transfer request sent']);
  }
}
