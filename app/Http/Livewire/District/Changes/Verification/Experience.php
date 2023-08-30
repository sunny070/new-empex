<?php

namespace App\Http\Livewire\District\Changes\Verification;

use App\Models\AdminDistrict;
use App\Models\ChangeExperience;
use App\Models\District;
use Livewire\Component;

class Experience extends Component
{
	public $districts;
	public $name;
	public $district;
	public $authDistricts;

	public function mount()
	{
		$this->authDistricts = AdminDistrict::where('admin_id', auth()->guard('admin')->id())->pluck('district_id')->toArray();
		$this->districts = District::whereIn('id', $this->authDistricts)->orderBy('name', 'ASC')->get();
	}

	public function render()
	{
		return view('livewire.district.changes.verification.experience', [
			'experiences' => ChangeExperience::where('status', 'Pending')
				->whereIn('user_district_id', $this->authDistricts)
				->when($this->district, fn ($q) => $q->where('user_district_id', $this->district))
				->with([
					'user' => fn ($q) => $q->with('basicInfo'),
					'district'
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
