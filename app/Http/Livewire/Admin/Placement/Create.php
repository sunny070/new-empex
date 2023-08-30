<?php

namespace App\Http\Livewire\Admin\Placement;

use App\Models\AdminDistrict;
use App\Models\BasicInfo;
use App\Models\District;
use App\Models\Placement;
use Livewire\Component;

class Create extends Component
{
    public $employmentNos;

    public $regNo = null, $recruiterName, $designation, $type, $recruit_date, $district, $districts, $address;


    // public function updatedRegno($reg_no)
    // {
    //     // $this->allDistricts = District::where('state_id', $state)->get();

    //     // dd($reg_no);
    // }

    public function mount()
    {

        if (auth()->guard('admin')->user()->role_id != 5 && auth()->guard('admin')->user()->role_id != 1) {
            abort(401);
        }


        if (auth()->guard('admin')->user()->role_id == 1)
            $this->districts = District::query()->get(['id', 'name']);
        else {

            $authDistricts = AdminDistrict::where('admin_id', auth()->guard('admin')->id())->pluck('district_id')->toArray();
            $this->districts = District::query()->whereIn('id', $authDistricts)->get(['id', 'name']);
        }
    }
    public function render()
    {

        return view('livewire.admin.placement.create');
    }


    public function hydrate()
    {
        $this->emit('select2AutoInit');
        $this->resetErrorBag();
    }

    public function storePlacement()
    {
        // dd($this->district);
        $this->validate([
            'regNo' => 'required',
            'recruiterName' => 'required',
            'designation' => 'required',
            'type' => 'required',
            'district' => 'required',
            'recruit_date' => 'required',
            'address' => 'required',
        ]);

        $data = new Placement([
            'employment_no' => $this->regNo,
            'recruiter_name' => $this->recruiterName,
            'designation' => $this->designation,
            'type' => $this->type,
            'district_id' => $this->district,
            'recruit_date' => $this->recruit_date,
            'address' => $this->address,
        ]);
        $data->save();

        // return redirect()->route('admin.placement', ['district' => 1]);
        return redirect()->route(auth()->guard('admin')->user()->role_id == 1 ? 'admin.placement' : 'district-admin.placement', ['district' => $this->districts[0]->id]);
    }
}
