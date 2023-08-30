<?php

namespace App\Http\Livewire\Web;

use App\Jobs\SendOtp;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class SignupUser extends Component
{
    public $name, $mobile_no, $otp=1234;
    public $showOtp = false;
    public $showResendTimer = false;
    public $showResendLink = false;
    public $otpSent = null;

    protected $rules = [
        'name' => 'required',
        'mobile_no' => [
            'required',
            'digits:10',
        ],
    ];

    protected $listeners = ['showLink'];

    public function showLink()
    {
        $this->showResendLink = true;
        $this->showResendTimer = false;
    }

    public function registerUsingPhone()
    {
        $this->validate();

        // $this->otpSent = '1234';
        // $this->otpSent = env('APP_ENV') == 'local' ? 0000 : rand(1000, 9999);
        $this->otpSent = env('APP_ENV') == 'local' ? 0000 : rand(1000, 9999);
        env('APP_ENV') != 'local' && $this->sendOtp($this->mobile_no, $this->otpSent);

        $this->otp = null;
        $this->showOtp = true;
        $this->showResendTimer = true;
    }

    public function resendOTP()
    {
//         $this->otpSent = '1234';
        $this->otpSent = rand(1000, 9999);
        $this->sendOtp($this->mobile_no, $this->otpSent);

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

        if ($this->otpSent == $this->otp) {
            $user = User::firstOrNew(['mobile_no' => $this->mobile_no]);
            $user->name = $this->name;
            $user->mobile_no = $this->mobile_no;
            $user->otp = null;
            $user->save();

            Auth::login($user);

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
        return view('livewire.web.signup-user');
    }
}
