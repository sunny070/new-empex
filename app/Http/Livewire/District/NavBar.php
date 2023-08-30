<?php

namespace App\Http\Livewire\District;

use App\Models\AdminDistrict;
use App\Models\BasicInfo;
use App\Models\OnGoingApplication;
use App\Models\Renew;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class NavBar extends Component
{
    public $newApp;
    public $renew;
    public $verifyChange, $approveChange;
    public $district_id;

    public function mount()
    {
        $authDistricts = AdminDistrict::where('admin_id', auth()->guard('admin')->id())->pluck('district_id')->toArray();
        // Log::info('authdistrict'.$authDistricts);
        $this->newApp = BasicInfo::where('canEdit', 0)->where('status', '!=', 'Approved')->whereIn('district_id', $authDistricts)->count();
        $this->renew = Renew::where('status', 'Pending')->whereIn('district_id', $authDistricts)->count();
        // $this->verifyChange = OnGoingApplication::where('type', 'LIKE', 'Change request%')->where('status', 'Pending')->count();
        // $this->approveChange = OnGoingApplication::where('type', 'LIKE', 'Change request%')->where('status', 'Verified')->count();

        //added by rj
        $this->verifyChange = OnGoingApplication::where('type', 'LIKE', 'Change request%')->where('status', 'Pending')->whereHas('user', function ($q) use ($authDistricts) {
            return $q->whereHas('basicInfo', function ($query) use ($authDistricts) {
                return $query->whereIn('district_id', $authDistricts);
            });
        })->count();
        $this->approveChange =  OnGoingApplication::where('type', 'LIKE', 'Change request%')->where('status', 'Verified')->whereHas('user', function ($q) use ($authDistricts) {
            return $q->whereHas('basicInfo', function ($query) use ($authDistricts) {
                return $query->whereIn('district_id', $authDistricts);
            });
        })->count();

        $this->district_id = $authDistricts[0];
        //added by rj
    }

    public function render()
    {
        // dd('navbar');

        return view('livewire.district.nav-bar');
    }
}
