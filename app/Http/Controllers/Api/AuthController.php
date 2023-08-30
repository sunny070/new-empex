<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Jobs\SendOtp;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class AuthController extends Controller
{
  public function register(LoginRequest $request)
  {
    Log::info($request->all());
    $user = User::where('mobile_no', $request->mobile_no)->first();
    if ($request->mobile_no == '1234567890') {
      $otp = '1234';
      if ($user != null) {
        $user->otp = $otp;
        $user->save();
      } else {
        $user = new User;
        $user->name = $request->name;
        $user->mobile_no = $request->mobile_no;
        $user->otp = $otp;
        $user->save();
      }
      Http::withHeaders([
        'Authorization' => "Bearer " . env('SMS_TOKEN'),
      ])->get("https://sms.msegs.in/api/send-otp", [
        'template_id' => "1407164818910899033",
        'message' => "Your OTP for EmpEx is $user->otp . It will be valid for 30 Minutes",
        'recipient' => $user->mobile_no
      ]);
      // SendOtp::dispatch($request->mobile_no, $otp)->delay(now()->addSeconds(5));
      return response()->json(['otp' => 'OTP sent to your mobile no.', 'user_id' => $user->id]);
    }

    $otp = rand(1000, 9999);

    if ($user != null) {
      $user->otp = $otp;
      $user->save();
    } else {
      $user = new User;
      $user->name = $request->name;
      $user->mobile_no = $request->mobile_no;
      $user->otp = $otp;
      $user->save();
    }
    Http::withHeaders([
      'Authorization' => "Bearer " . env('SMS_TOKEN'),
    ])->get("https://sms.msegs.in/api/send-otp", [
      'template_id' => "1407164818910899033",
      'message' => "Your OTP for EmpEx is $user->otp . It will be valid for 30 Minutes",
      'recipient' => $user->mobile_no
    ]);
    // SendOtp::dispatch($request->mobile_no, $otp)->delay(now()->addSeconds(5));
    return response()->json(['otp' => 'OTP sent to your mobile no.', 'user_id' => $user->id]);
  }

  public function verifyOtp(Request $request)
  {
    Log::info($request->otp);
    $user = User::findOrFail($request->user_id);
    if ($user->otp == $request->otp) {
      Auth::login($user);
      $user->otp = 'null';
      $user->save();
      $success['user'] = Auth::user();
      $token = Auth::user()->createToken('empex_token');
      $success['token'] = $token->plainTextToken;
      return response()->json(['success' => $success], 200);
    } else {
      return response()->json(['error' => 'The provided OTP does not match!'], 401);
    }
  }
}
