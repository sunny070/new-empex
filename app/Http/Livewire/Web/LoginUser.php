<?php

namespace App\Http\Livewire\Web;

use App\Jobs\SendOtp;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class LoginUser extends Component
{
    public $mobile_no, $otp;
    public $showOtp = false;
    public $showResendTimer = false;
    public $showResendLink = false;

    protected $rules = [
        'mobile_no' => 'required|digits:10',
    ];

    protected $listeners = ['showLink'];

    public function showLink()
    {
        $this->showResendLink = true;
        $this->showResendTimer = false;
    }

    public function loginUserUsingPhone()
    {
        $this->validate();
        $user = User::where('mobile_no', $this->mobile_no)->first();

        if (!$user) {
            session()->flash('error', 'Mobile number does not match our record');
        } else {
            $user->otp = env('APP_ENV') == 'local' ? 0000 : rand(1000, 9999);
            // $user->otp = '1234';
            $user->save();

            env('APP_ENV') != 'local' && $this->sendOtp($this->mobile_no, $user->otp);
            // if (env('APP_ENV') != 'local')
            // $this->sendOtp($this->mobile_no, $user->otp);

            $this->showOtp = true;
            $this->showResendTimer = true;
        }
    }

    public function resendOTP()
    {
        $user = User::where('mobile_no', $this->mobile_no)->first();
        $user->otp = env('APP_ENV') == 'local' ? 0000 : rand(1000, 9999);
         $user->otp = '1234';
        $user->save();

        $this->sendOtp($this->mobile_no, $user->otp);

        $this->emit('resend');
        $this->showResendLink = false;
        $this->showResendTimer = true;
    }

    public function loginUserUsingPhoneAndOtp()
    {
        $this->validate([
            'mobile_no' => 'required|digits:10',
            'otp' => 'required|digits:4'
        ]);

        $user = User::where('mobile_no', $this->mobile_no)->first();
        if ($user->otp == $this->otp) {
            Auth::login($user);
            $user->otp = null;
            $user->save();

            return redirect(route('auth.dashboard'));
        } else {
            session()->flash('otpError', 'OTP does not match our record');
        }
    }

    public function sendOtp($no, $otp)
    {
        Http::withHeaders([
            'Authorization' => "Bearer " . env('SMS_TOKEN'),
        ])->get("https://sms.msegs.in/api/send-otp", [
            'template_id' => "1407164818910899033",
            'message' => "Your OTP for EmpEx is $otp . It will be valid for 30 Minutes",
            'recipient' => $no
        ]);
//        SendOtp::dispatch($no, $otp)->delay(now()->addSeconds(5))->onQueue('high');
    }

    public function hydrate()
    {
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.web.login-user');
    }
}
