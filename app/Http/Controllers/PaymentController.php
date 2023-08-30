<?php

namespace App\Http\Controllers;

use App\Jobs\SendStatusSms;
use App\Models\BasicInfo;
use App\Models\OnGoingApplication;
use App\Models\Payment;
use App\Models\Renew;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
  public function responseHandler(Request $request)
  {
    $payment = new Payment();
    $payment->user_id = auth()->id();
    $payment->transactionId = $request->transactionId;
    $payment->orderId = $request->orderId;
    $payment->currency = $request->currency;
    $payment->status = $request->status;
    $payment->amount = $request->amount;
    $payment->save();

    if ($request->status == 'TXN_SUCCESS') {
      $basic_info = BasicInfo::where('user_id', auth()->id())->latest('updated_at')->first();
      $basic_info->canEdit = 0;
      $basic_info->status = 'Pending';
      $basic_info->notes = null;
      $basic_info->percent_complete = '100';
      $basic_info->is_paid = 1;
      $basic_info->save();

      $ongoing = new OnGoingApplication;
      $ongoing->user_id = auth()->id();
      $ongoing->type = 'New Application';
      $ongoing->model_name = 'BasicInfo';
      $ongoing->requested_id = $basic_info->id;
      $ongoing->status = 'Pending';
      $ongoing->color = '#2d9735';
      $ongoing->bg = '#e1ffe3';
      $ongoing->save();
      SendStatusSms::dispatch($basic_info->mobile_no, 'apply for employment card', 'received')->delay(30);
      return redirect(route('auth.employee.confirmation'));
    } else {
      return redirect(route('auth.employee.failed.payment'));
    }
  }

  public function renewResponseHandler(Request $request)
  {
    $payment = new Payment();
    $payment->user_id = auth()->id();
    $payment->transactionId = $request->transactionId;
    $payment->orderId = $request->orderId;
    $payment->currency = $request->currency;
    $payment->status = $request->status;
    $payment->amount = $request->amount;
    $payment->save();

    if ($request->status == 'TXN_SUCCESS') {
      $basicInfo = BasicInfo::where('user_id', auth()->id())->where('status', 'Approved')->latest('updated_at')->first();
      $renew = new Renew();
      $renew->user_id = auth()->id();
      $renew->active_from = $basicInfo->card_valid_from;
      $renew->active_till = $basicInfo->card_valid_till;
      $renew->aadhar_no = $basicInfo->aadhar_no;
      $renew->gender = $basicInfo->gender;
      $renew->district_id = $basicInfo->district_id;
      $renew->name = $basicInfo->full_name;
      $renew->save();

      $ongoing = new OnGoingApplication();
      $ongoing->user_id = auth()->id();
      $ongoing->type = 'Renewal';
      $ongoing->model_name = 'Renew';
      $ongoing->requested_id = $renew->id;
      $ongoing->status = 'Pending';
      $ongoing->color = '#2072ff';
      $ongoing->bg = '#eff5ff';
      $ongoing->save();

      SendStatusSms::dispatch(auth()->user()->mobile_no, 'renew employment card', 'received')->delay(30);

      session()->flash('message', 'Card renewal submitted successfully!');
      return redirect(route('auth.dashboard'));
    } else {
      session()->flash('error', 'Error occured! please try again later');
      return redirect(route('auth.enrollment.renew'));
    }
  }
}
