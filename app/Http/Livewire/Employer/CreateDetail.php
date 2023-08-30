<?php

namespace App\Http\Livewire\Employer;

use App\Jobs\SendOtp;
use App\Models\Admin;
use App\Models\District;
use App\Models\OrganizationAddress;
use App\Models\State;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class CreateDetail extends ModalComponent
{
	use WithFileUploads;

	public $allStates, $allDistricts;
	public $state, $district, $address2, $address1, $pincode;
	public $name, $contactNo;
	public $step = 1;
	public $otpSent, $otp, $image;
	public $showOtpField = false;

	public static function closeModalOnEscape(): bool
	{
		return false;
	}

	public static function closeModalOnClickAway(): bool
	{
		return false;
	}

	public function mount()
	{
		$this->allStates = State::get();
		$this->allDistricts = collect();
	}

	public function hydrate()
	{
		$this->resetErrorBag();
	}

	public function render()
	{
		return view('livewire.employer.create-detail');
	}

	public function updatedState()
	{
		$this->allDistricts = District::where('state_id', $this->state)->get();
	}

	public function goToStep2()
	{
		$this->validate([
			'address1' => 'required',
			'state' => 'required',
			'district' => 'required',
			'pincode' => 'required',
		]);

		$this->step = 2;
	}

	public function returnToStep1()
	{
		$this->showOtpField = false;
		$this->step = 1;
	}

	public function submit()
	{
		$this->validate([
			'image' => 'required|max:2048',
			'name' => 'required',
			'contactNo' => 'required|digits:10|unique:admins,contact',
		]);

		// $this->otpSent = '1234';
		$this->otpSent = env('APP_ENV') == 'local' ? 0000 : rand(1000, 9999);
		SendOtp::dispatch($this->contactNo, $this->otpSent)->delay(30);
		$this->showOtpField = true;
	}

	public function save()
	{
		$this->validate([
			'otp' => 'required|digits:4'
		]);

		if ($this->otpSent == $this->otp) {
			$admin = Admin::where('id', auth()->guard('admin')->id())->with('organization')->first();
			$admin->name = $this->name;
			$admin->contact = $this->contactNo;
			$admin->profile_photo_path = $this->image->storePublicly('admin', 'public');
			$admin->active = 1;
			$admin->save();

			$orgAddress = new OrganizationAddress();
			$orgAddress->admin_id = $admin->id;
			$orgAddress->organization_id = $admin->organization->id;
			$orgAddress->state_id = $this->state;
			$orgAddress->district_id = $this->district;
			$orgAddress->address1 = $this->address1;
			$orgAddress->address2 = $this->address2;
			$orgAddress->pincode = $this->pincode;
			$orgAddress->save();

			$this->closeModal();

			return redirect(route('employer.dashboard'));
		} else {
			session()->flash('otpError', 'Please enter valid OTP');
		}
	}
}
