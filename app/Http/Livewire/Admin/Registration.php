<?php

namespace App\Http\Livewire\Admin;

use App\Jobs\SendEmployerStatus;
use App\Jobs\SendOtp;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Department;
use App\Models\District;
use App\Models\Organization;
use App\Models\OrganizationAddress;
use App\Models\Sector;
use App\Models\State;
use App\Models\Type;
use Livewire\Component;
use Livewire\WithFileUploads;

class Registration extends Component
{
    use WithFileUploads;

    public $step = 1;
    public $categories, $types, $sectors, $departments;
    public $allStates, $allDistricts;

    public $organizationCategory, $organizationType, $organizationName, $organizationPan, $sector, $departmentName, $organizationTan;
    public $state, $district, $address2, $address1, $pincode, $districtName;
    public $name, $email, $contactNo, $password, $officeOrder;
    public $termsAndCondition;
    public $aadhaar, $image;
    public $otpSent, $otp;

    public function updatedOrganizationCategory()
    {
        $this->types = Type::where('category_id', $this->organizationCategory)->get();
    }

    public function updatedState()
    {
        if ($this->state == 1)
            $this->allDistricts = District::where('state_id', $this->state)->get();
    }

    public function continueToStep2()
    {
        $this->validate([
            'organizationCategory' => 'required',
            'organizationType' => 'required',
            'organizationName' => 'required_if:organizationCategory,1,2',
            'departmentName' => 'required_if:organizationCategory,3',
            'sector' => 'required',
        ]);

        $this->step = 2;
    }

    public function backToStep1()
    {
        $this->step = 1;
    }

    public function backToStep2()
    {
        $this->step = 2;
    }

    public function backToStep3()
    {
        $this->step = 3;
    }

    public function continueToStep3()
    {
        // dd($this->state==1);
        $this->validate([
            'address1' => 'required',
            'state' => 'required',
            'district' => $this->state == 1 ? 'required' : 'nullable',
            'districtName' => ($this->state == 1) ? 'nullable' : 'required',
            'pincode' => 'required',
        ]);

        $this->step = 3;
    }

    public function sendOtp()
    {
        $this->validate([
            'image' => 'required|max:2048',
            'name' => 'required',
            'email' => 'required|unique:admins,email|email',
            'contactNo' => 'required|digits:10|unique:admins,contact',
            'password' => 'required',
            'termsAndCondition' => 'accepted'
        ]);

        // $this->otpSent = '1234';
        $this->otpSent = env('APP_ENV') == 'local' ? 0000 : rand(1000, 9999);
        SendOtp::dispatch($this->contactNo, $this->otpSent)->delay(now()->addSeconds(5));
        $this->step = 4;
    }

    public function submit()
    {
        $this->validate([
            'otp' => 'required|digits:4'
        ]);

        if ($this->otpSent == $this->otp) {
            $admin = new Admin();
            $admin->name = $this->name;
            $admin->email = $this->email;
            $admin->contact = $this->contactNo;
            $admin->password = $this->password;
            $admin->role_id = 4;
            $admin->category_id = $this->organizationCategory;
            $admin->otp = null;
            $admin->profile_photo_path = $this->image->storePublicly('admin', 'public');
            $admin->active = 1;
            $admin->save();

            $org = new Organization();
            $org->admin_id = $admin->id;
            $org->category_id = $this->organizationCategory;
            $org->type_id = $this->organizationType;
            $org->sector_id = $this->sector;
            if ($this->organizationCategory == 3) {
                $org->department_id = $this->departmentName;
            } else {
                $org->name = $this->organizationName;
            }
            $org->save();

            $orgAddress = new OrganizationAddress();
            $orgAddress->admin_id = $admin->id;
            $orgAddress->organization_id = $org->id;
            $orgAddress->state_id = $this->state;
            $orgAddress->district_id = $this->state == 1 ? $this->district : null;
            $orgAddress->district_name = $this->state == 1 ? null : $this->districtName;
            $orgAddress->address1 = $this->address1;
            $orgAddress->address2 = $this->address2;
            $orgAddress->pincode = $this->pincode;
            $orgAddress->save();

            SendEmployerStatus::dispatch($this->contactNo, 'Received')->delay(now()->addSeconds(5));

            session()->flash('status', 'Registration successfully, Authorised personnel will confirm the registration and we\'ll notify you.');
            return redirect(route('admin.login'));
        } else {
            session()->flash('otpError', 'Please enter valid OTP');
        }
    }

    public function mount()
    {
        $this->departments = Department::orderBy('name', 'ASC')->get();
        $this->categories = Category::get();
        $this->types = collect();
        $this->sectors = Sector::orderBy('name', 'ASC')->get();
        $this->allStates = State::get();
        $this->allDistricts = collect();
        $this->districtName = collect();
    }

    public function hydrate()
    {
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.admin.registration');
    }
}
