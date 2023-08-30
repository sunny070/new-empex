<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\SendStatusSms;
use App\Models\BasicInfo;
use App\Models\ChangeAddress;
use App\Models\OnGoingApplication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AddressChangeController extends Controller
{
  public function checkChangeAddress($id)
  {
    $check = ChangeAddress::where('user_id', $id)->first();
    if ($check != null) {
      return response()->json(200);
    } else {
      return response()->noContent();
    }
  }
  public function changeAddress(Request $request)
  {
    $addresses = json_decode($request->addresses, true);

    Log::info($request->all());

    foreach ($addresses as $address) {
      $saveAddress = ChangeAddress::firstOrNew(
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
      // $saveAddress->same_as_permanent = $address["same_as_permanent"] == 'true' ? 1 : 0;
      $saveAddress->type = $address["type"];
      if ($address['type'] == 'permanent') {
        $dist_id = $address["district_id"];
        $saveAddress->user_district_id = $dist_id;
      }
      $saveAddress->save();


    }

    $ongoing = new OnGoingApplication;
    $ongoing->user_id = $request->user_id;
    $ongoing->type = 'Change request - Address';
    $ongoing->model_name = 'ChangeAddress';
    $ongoing->requested_id = $saveAddress->id;
    $ongoing->status = 'Pending';
    $ongoing->color = '#ff7e0e';
    $ongoing->bg = '#fff5ef';
    $ongoing->save();

    $user = BasicInfo::where('user_id', $request->user_id)->first();

    SendStatusSms::dispatch($user->phone_no, 'change address', 'received')->delay(30);

    return response()->json(['success' => 'Change Request Submitted Successfully']);
  }
}
