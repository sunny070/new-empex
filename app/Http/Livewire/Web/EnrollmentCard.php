<?php

namespace App\Http\Livewire\Web;

use App\Models\Address;
use App\Models\BasicInfo;
use App\Models\EducationQualification;
use App\Models\NcoDetail;
use App\Models\RegisteringAuthority;
use App\Models\RegisteringAuthorityDistrict;
use App\Models\UserNco;
use Livewire\Component;

class EnrollmentCard extends Component
{
    public $image;
    public $from, $to;
    public $empNo;
    public $highestEducation;
    public $address;
    public $phone;
    public $name;
    public $qr;
    public $ncoCodeToDisplay;
    public $signature;

    public function mount()
    {
        // $userBio = BasicInfo::where('user_id', auth()->id())->first();
        //new code
        $userBio = BasicInfo::where('user_id', auth()->id())->where('status', 'Approved')->latest('card_valid_till')->first();


        $authPreferNcoCode = UserNco::where('user_id', auth()->id())->where('nco_code_display', '!=', null)->value('nco_code_display');
        $this->ncoCodeToDisplay = NcoDetail::where('id', $authPreferNcoCode)->value('code');

        if ($userBio) {
            $this->from = $userBio->card_valid_from;
            $this->to = $userBio->card_valid_till;
            $this->empNo = $userBio->employment_no;
            $this->image = $userBio->avatar;
            $this->phone = $userBio->phone_no;
            $this->name = $userBio->full_name;
            $this->qr = $userBio->qr;

            $this->address = Address::with('district', 'state')->where('user_id', auth()->id())->where('type', 'permanent')->first();

            $authorityDistrict = RegisteringAuthorityDistrict::where('district_id', $userBio->district_id)->value('registering_authority_id');

            $this->signature = RegisteringAuthority::where('id', $authorityDistrict)->first();
        }
    }

    public function render()
    {
        return view('livewire.web.enrollment-card');
    }
}
