<?php

namespace App\Http\Livewire\Admin\Approval\Change;

use App\Models\ChangeEducation;
use App\Models\District;
use Livewire\Component;

class Education extends Component
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
		return view('livewire.admin.approval.change.education', [
			'educations' => ChangeEducation::where('status', 'Verified')
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
