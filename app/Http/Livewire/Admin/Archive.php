<?php

namespace App\Http\Livewire\Admin;

use App\Models\Archive as ModelsArchive;
use Livewire\Component;
use Livewire\WithPagination;

class Archive extends Component
{
	use WithPagination;
	public $years;
	public $year;
	public $name;

	public function mount()
	{
		$this->years = range(date('Y'), date('Y') - 10);
	}

	public function render()
	{
		return view('livewire.admin.archive', [
			'archivedUser' => ModelsArchive::orderBy('created_at', 'desc')
				->when($this->year, fn ($q) => $q->whereYear('card_valid_till', $this->year))
				->when(
					$this->name,
					fn ($q) => $q->where('name', 'like', '%' . $this->name . '%')
						->orWhere('employment_no', 'like', '%' . $this->name . '%')
				)
				->paginate(),
		]);
	}
}
