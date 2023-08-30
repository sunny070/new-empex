<?php

namespace App\Http\Livewire\Employer;

use App\Jobs\SendOtp;
use App\Models\Admin;
use App\Models\District;
use App\Models\OrganizationAddress;
use App\Models\State;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class Profile extends ModalComponent
{
    use WithFileUploads;

    public $step = 1;
    public $allStates, $allDistricts;
    public $state, $district, $address2, $address1, $pincode, $districtName;
    public $name, $email, $contactNo, $password, $image;
    public $changeContact = false;
    public $otp, $otpSent;

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
        $this->allDistricts = District::get();

        $orgAddress = OrganizationAddress::where('admin_id', auth()->id())->first();
        $this->state = $orgAddress->state_id;
        $this->district = $orgAddress->district_id;
        $this->districtName = $orgAddress->district_name;
        $this->address1 = $orgAddress->address1;
        $this->address2 = $orgAddress->address2;
        $this->pincode = $orgAddress->pincode;

        $this->name = auth()->guard('admin')->user()->name;
        $this->email = auth()->guard('admin')->user()->email;
        $this->contactNo = auth()->guard('admin')->user()->contact;
    }

    public function render()
    {
        return view('livewire.employer.profile');
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
            // 'district' => 'required',
            'district' => $this->state == 1 ? 'required' : 'nullable',
            'districtName' => ($this->state == 1) ? 'nullable' : 'required',
            'pincode' => 'required',
        ]);

        $this->step = 2;
    }

    public function returnToStep1()
    {
        $this->step = 1;
    }

    public function returnToStep2()
    {
        $this->step = 2;
    }

    public function save()
    {
        $this->validate([
            'image' => 'nullable|max:2048',
            'name' => 'required',
            'email' => 'required|unique:admins,email,' . auth()->guard('admin')->id(),
            'contactNo' => 'required|digits:10|unique:admins,contact,' . auth()->guard('admin')->id(),
            'password' => 'nullable|min:6',
        ]);

        if ($this->contactNo != auth()->guard('admin')->user()->contact) {
            // $this->otpSent = '1234';
            $this->otpSent = rand(1000, 9999);
            SendOtp::dispatch($this->contactNo, $this->otpSent)->delay(now()->addSeconds(5));
            $this->step = 3;
        } else {
            $this->updateDetail();
        }
    }

    public function submit()
    {
        $this->validate([
            'otp' => 'required|digits:4'
        ]);

        if ($this->otpSent == $this->otp) {
            $this->updateDetail();
        } else {
            session()->flash('otpError', 'Please enter valid OTP');
        }
    }

    public function updateDetail()
    {
        $admin = Admin::where('id', auth()->guard('admin')->id())->first();
        $admin->name = $this->name;
        $admin->contact = $this->contactNo;
        $admin->email = $this->email;
        if ($this->image) {
            $admin->profile_photo_path = $this->image->storePublicly('admin', 'public');
        }
        if ($this->password) {
            $admin->password = $this->password;
        }

        $admin->save();

        $orgAddress = OrganizationAddress::where('admin_id', $admin->id)->first();
        $orgAddress->state_id = $this->state;
        // $orgAddress->district_id = $this->district;
        //added rj
        $orgAddress->district_id = $this->state == 1 ? $this->district : null;
        $orgAddress->district_name = $this->state == 1 ? null : $this->districtName;
        //added rj
        $orgAddress->address1 = $this->address1;
        $orgAddress->address2 = $this->address2;
        $orgAddress->pincode = $this->pincode;
        $orgAddress->save();

        $this->closeModal();

        return redirect(route('employer.dashboard'));
    }
}
