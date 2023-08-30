<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\SendStatusSms;
use App\Models\BasicInfo;
use App\Models\OnGoingApplication;
use App\Models\Payment;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;

class PaymentController extends Controller
{
  public function makePayment(Request $request)
  {
    $orderId = 'empex-' . now()->timestamp;
    $payment = new Payment();
    $payment->user_id = $request->user_id;
    $payment->orderId = $orderId;
    $payment->save();

    $customer = 'Empex';
    $customer = json_encode($customer);

    if (env('APP_ENV') == 'local') {
      $url = 'https://paymentgw.mizoram.gov.in/api/mobile-initiate-test-payment'; // test
    } else {
      $url = 'https://paymentgw.mizoram.gov.in/api/initiate-mobile-payment'; // prod
    }

    $client = new Client();
    $response = $client->request('POST', $url, [
      'form_params' => [
        'callback_url' =>  URL::to('/') . '/api/response-handler',
        'order_id' => $orderId,
        'amount' => 10,
        'department_id' => 1,
        'customer' => $customer,
        'shouldSplit' => false
      ]
    ]);
    $response = json_decode($response->getBody());

    return response()->json($response);
  }

  public function responseHandler(Request $request)
  {
    $payment = Payment::where('orderId', $request->orderId)->first();
    $payment->transactionId = $request->transactionId;
    $payment->orderId = $request->orderId;
    $payment->currency = $request->currency;
    $payment->status = $request->status;
    $payment->amount = $request->amount;


    if ($request->status == 'TXN_SUCCESS') {
      info($request->transactionId);
      // dd('li');
      $basic_info = BasicInfo::where('user_id', $payment->user_id)->first();
      $basic_info->canEdit = 0;
      $basic_info->status = 'Pending';
      $basic_info->notes = null;
      $basic_info->is_paid = 1;
      // $basic_info->percent_complete=100;
      $basic_info->save();
      $payment->save();

      $ongoing = new OnGoingApplication();
      $ongoing->user_id = $payment->user_id;
      $ongoing->type = 'New Application';
      $ongoing->model_name = 'BasicInfo';
      $ongoing->requested_id = $basic_info->id;
      $ongoing->status = 'Pending';
      $ongoing->color = '#2d9735';
      $ongoing->bg = '#e1ffe3';
      $ongoing->save();
      SendStatusSms::dispatch($basic_info->mobile_no, 'apply for employment card', 'received')->delay(30);
    } else {
      info('li lo');
    }
    return response()->json($payment, 200);
  }
}
