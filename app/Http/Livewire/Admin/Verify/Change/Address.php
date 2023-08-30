<?php

namespace App\Http\Livewire\Admin\Verify\Change;

use App\Models\ChangeAddress;
use App\Models\District;
use Livewire\Component;

class Address extends Component
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
		return view('livewire.admin.verify.change.address', [
			'addresses' => ChangeAddress::where('status', 'Pending')
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
