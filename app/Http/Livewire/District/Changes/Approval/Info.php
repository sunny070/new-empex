<?php

namespace App\Http\Livewire\District\Changes\Approval;

use App\Models\AdminDistrict;
use App\Models\ChangeBasicInfo;
use App\Models\District;
use Livewire\Component;

class Info extends Component
{
	public $districts;
	public $district;
	public $name;
	public $authDistricts;

	public function mount()
	{
		$this->authDistricts = AdminDistrict::where('admin_id', auth()->guard('admin')->id())->pluck('district_id')->toArray();
		$this->districts = District::whereIn('id', $this->authDistricts)->orderBy('name', 'ASC')->get();
	}

	public function render()
	{
		return view('livewire.district.changes.approval.info', [
			'basicInfo' => ChangeBasicInfo::where('status', 'Verified')
				->whereIn('user_district_id', $this->authDistricts)
				->with('district')
				->when($this->district, fn ($q) => $q->where('user_district_id', $this->district))
				->when($this->name, fn ($q) => $q->where('full_name', 'like', '%' . $this->name . '%'))
				->get()
		]);
	}
}
