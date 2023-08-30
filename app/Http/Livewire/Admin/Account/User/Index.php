<?php

namespace App\Http\Livewire\Admin\Account\User;

use App\Models\BasicInfo;
use App\Models\District;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
	use WithPagination;

	public $districts;
	public $name;
	public $district;

	public function changeIsPlaced($id)
	{
		$data = BasicInfo::where('id', $id)->first();
		$data->is_placed = !$data->is_placed;
		$data->save();
	}

	public function mount()
	{
		$this->districts = District::orderBy('name', 'ASC')->get();
	}

	public function render()
	{
		return view('livewire.admin.account.user.index', [
			'users' => BasicInfo::where('canEdit', 0)
				->where('status', 'Approved')
				->with('district')
				->when($this->name, function ($q) {
					return $q->where('full_name', 'like', '%' . $this->name . '%')
						->orWhere('employment_no', 'like', '%' . $this->name . '%');
				})
				->when($this->district, function ($q) {
					$q->where('district_id', $this->district);
				})
				->paginate()
		]);
	}
}
