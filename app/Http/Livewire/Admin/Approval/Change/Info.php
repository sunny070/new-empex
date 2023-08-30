<?php

namespace App\Http\Livewire\Admin\Approval\Change;

use App\Models\ChangeBasicInfo;
use App\Models\District;
use Livewire\Component;

class Info extends Component
{
    public $districts;
    public $district;
    public $name;

    public function mount()
    {
        $this->districts = District::orderBy('name', 'ASC')->get();
    }

    public function render()
    {
        return view('livewire.admin.approval.change.info', [
            'basicInfo' => ChangeBasicInfo::where('status', 'Verified')
                ->when($this->district, fn ($q) => $q->where('user_district_id', $this->district))
                ->when($this->name, fn ($q) => $q->where('full_name', 'like', '%' . $this->name . '%'))
                ->with('district')
                ->get()
        ]);
    }
}
