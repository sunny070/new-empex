<?php

namespace App\Http\Livewire\District;

use App\Models\AdminDistrict;
use App\Models\BasicInfo;
use App\Models\District;
use Livewire\Component;
use Livewire\WithPagination;

class Employee extends Component
{
	use WithPagination;

	public $districts;
	public $name;
	public $district;
	public $authDistricts;

	public function changeIsPlaced($id)
	{
		$data = BasicInfo::where('id', $id)->first();
		$data->is_placed = !$data->is_placed;
		$data->save();
	}

	public function mount()
	{
		$this->authDistricts = AdminDistrict::where('admin_id', auth()->guard('admin')->id())->pluck('district_id')->toArray();
		$this->districts = District::whereIn('id', $this->authDistricts)->orderBy('name', 'ASC')->get();
	}

	public function render()
	{
		return view('livewire.district.employee', [
			'employments' => BasicInfo::where('canEdit', 0)
				->where('status', 'Approved')
				->whereIn('district_id', $this->authDistricts)
				->with('district')
				->when($this->name, fn ($q) => $q->where('full_name', 'like', '%' . $this->name . '%'))
				->when($this->district, fn ($q) => $q->where('district_id', $this->district))
				->paginate()
		]);
	}
}
