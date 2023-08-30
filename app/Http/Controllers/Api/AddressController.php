<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\BasicInfo;
use Illuminate\Http\Request;

class AddressController extends Controller
{
  public function createAddress(Request $request)
  {
    $addresses = json_decode($request->addresses, true);
    info($addresses);
    $dist_id = null;

    foreach ($addresses as $address) {
      $saveAddress = Address::firstOrNew(
        ['user_id' => $request->user_id, 'type' => $address['type']],
      );
      $saveAddress->user_id = $request->user_id;
      $saveAddress->state_id = $address["state_id"];
      $saveAddress->district_id = $address["district_id"];
      $saveAddress->rd_block_id=$address['rd_block_id'];
      $saveAddress->post_office_id=$address['post_office_id'];
      $saveAddress->police_station_id=$address['police_station_id'];
      $saveAddress->village = $address["village"];
      $saveAddress->pin_code = $address["pin_code"];
      $saveAddress->house_no = $address["house_no"];
      $saveAddress->same_as_permanent = $address["same_as_permanent"] == 'true' ? 1 : 0;
      $saveAddress->type = $address["type"];
      $saveAddress->save();

      if ($address['type'] == 'permanent') {
        $dist_id = $address["district_id"];
      }
    }
    $basicInfo = BasicInfo::where('user_id', $request->user_id)->first();
    $basicInfo->percent_complete = 40;
    $basicInfo->district_id = $dist_id;
    $basicInfo->save();
    return response()->json(['success' => 'Submitted Successfully']);
  }

  public function getMyAddress(Request $request)
  {
   
    $addresses = Address::where('user_id', $request->user_id)->where('type','permanent')
   ->with(
      'state',
      'district',
      'RdBlock',
      'PostOffice',
      'PoliceStation',
   )
    ->first();
    info($addresses);
    if ($addresses == []) {
      return response()->noContent();
    }
    return response()->json(['addresses' => $addresses]);
  }

  public function getPresentAddress(Request $request)
  {
    $address = Address::where('user_id', $request->user_id)->where('type', 'Present')->first();
    if ($address == null) {
      return response()->noContent();
    }
    return response()->json(['presentAddress' => $address]);
  }
}
