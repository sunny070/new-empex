<?php

namespace App\Http\Livewire\Approver\Change\ListDetail;

use App\Models\AdminDistrict;
use App\Models\ChangeAddress;
use App\Models\District;
use Livewire\Component;

class Address extends Component
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
		return view('livewire.approver.change.list-detail.address', [
			'addresses' => ChangeAddress::where('status', 'Verified')
				->whereIn('user_district_id', $this->authDistricts)
				->when($this->district, fn ($q) => $q->where('user_district_id', $this->district))
				->with([
					'user' => fn ($q) => $q->with('basicInfo'),
					'user_district'
				])
				->when(
					$this->name,
					fn ($q) => $q->whereHas(
						'user.basicInfo',
						fn ($q) => $q->where('full_name', 'like', '%' . $this->name . '%')
					)
				)
				->get()
		]);
	}
}
