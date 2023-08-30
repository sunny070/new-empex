<?php

namespace App\Http\Livewire\Admin\Verify;

use App\Models\BasicInfo;
use App\Models\District;
use Livewire\Component;
use Livewire\WithPagination;

class NewApplication extends Component
{
	use WithPagination;

	public $districts;
	public $name;
	public $district;

	public function mount()
	{
		$this->districts = District::orderBy('name', 'ASC')->get();
	}

	public function render()
	{
		return view('livewire.admin.verify.new-application', [
			'basicInfos' => BasicInfo::where('canEdit', 0)
				->where('status', 'Pending')
				->with('user', 'district')
				->when($this->name, function ($q) {
					return $q->where('full_name', 'like', '%' . $this->name . '%');
				})
				->when($this->district, function ($q) {
					$q->where('district_id', $this->district);
				})
				->paginate()
		]);
	}
}
