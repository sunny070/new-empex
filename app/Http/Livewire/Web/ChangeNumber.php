<?php

namespace App\Http\Livewire\Web;

use App\Jobs\SendOtp;
use App\Models\BasicInfo;
use App\Models\User;
use Faker\Provider\Base;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChangeNumber extends Component
{
	public $employmentNo;
	public $name;
	public $parentName;
	public $dob;
	public $step = 1;
	public $mobileNo;
	public $showOtp = false;
	public $otp;
	public $jobseeker;

	public function hydrate()
	{
		$this->resetErrorBag();
	}

	public function render()
	{
		return view('livewire.web.change-number');
	}

	public function showPhone()
	{
		$this->validate([
			'employmentNo' => 'required|exists:basic_infos,employment_no',
			'name' => 'required|exists:basic_infos,full_name',
			'parentName' => 'required|exists:basic_infos,parents_name',
			'dob' => 'required|exists:basic_infos,dob',
		]);

		$this->jobseeker = BasicInfo::where('employment_no', $this->employmentNo)
			->where('full_name', $this->name)
			->where('parents_name', $this->parentName)
			->where('dob', $this->dob)
			->first();

		if ($this->jobseeker) {
			$this->step = 2;
		} else {
			session()->flash('error', 'Details does not match our record');
		}
	}

	public function requestOtp()
	{
		$this->validate([
			'mobileNo' => 'required|digits:10|unique:users,mobile_no',
		]);

		$user = User::where('id', $this->jobseeker->user_id)->first();
		// $user->otp = '1234';
		$user->otp = rand(1000, 9999);
		$user->save();
		$this->sendOtp($this->mobileNo, $user->otp);
		$this->showOtp = true;
	}

	public function submit()
	{
		$this->validate([
			'otp' => 'required|digits:4'
		]);

		$user = User::where('id', $this->jobseeker->user_id)->first();
		if ($user->otp == $this->otp) {
			Auth::login($user);
			$user->mobile_no = $this->mobileNo;
			$user->otp = null;
			$user->save();

			$seeker = $this->jobseeker;
			$seeker->phone_no = $this->mobileNo;
			$seeker->save();

			return redirect(route('auth.dashboard'));
		} else {
			session()->flash('otpError', 'OTP does not match our record');
		}
	}

	public function sendOtp($no, $otp)
	{
		SendOtp::dispatch($no, $otp)->delay(now()->addSeconds(5));
	}
}
