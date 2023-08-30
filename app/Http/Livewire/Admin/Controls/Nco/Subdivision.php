<?php

namespace App\Http\Livewire\Admin\Controls\Nco;

use App\Models\ChangeNco;
use App\Models\NcoDivision;
use App\Models\NcoGroup;
use App\Models\NcoSubDivision;
use App\Models\UserNco;
use Livewire\Component;
use Livewire\WithPagination;

class Subdivision extends Component
{
	use WithPagination;

	public $division;
	public $subDivisionName;
	public $subDivisionCode;
	public $subDivisionId;
	public $addDialog = false;
	public $updateDialog = false;
	public $deleteDialog = false;
	public $name;
	public $divis;

	public function openAddDialog()
	{
		$this->resetForm();
		$this->addDialog = true;
	}

	public function resetForm()
	{
		$this->reset([
			'division',
			'subDivisionName',
			'subDivisionCode',
			'subDivisionId',
		]);
	}

	public function addSubDivision()
	{
		$this->validate([
			'subDivisionName' => 'required',
			'subDivisionCode' => 'required',
			'division' => 'required'
		]);

		$div = new NcoSubDivision();
		$div->name = $this->subDivisionName;
		$div->code = $this->subDivisionCode;
		$div->nco_division_id = $this->division;
		$div->save();
		$this->addDialog = false;
	}

	public function openUpdateDialog($id, $name, $code, $divId)
	{
		$this->updateDialog = true;
		$this->division = $divId;
		$this->subDivisionId = $id;
		$this->subDivisionName = $name;
		$this->subDivisionCode = $code;
	}

	public function updateSubDivision()
	{
		$this->validate([
			'subDivisionName' => 'required',
			'subDivisionCode' => 'required',
			'division' => 'required'
		]);

		$div = NcoSubDivision::findOrFail($this->subDivisionId);
		$div->name = $this->subDivisionName;
		$div->code = $this->subDivisionCode;
		$div->nco_division_id = $this->division;
		$div->save();
		$this->updateDialog = false;
	}

	public function openDeleteDialog($id)
	{
		$this->subDivisionId = $id;
		$this->deleteDialog = true;
	}

	public function closeDeleteDialog()
	{
		$this->resetForm();
		$this->deleteDialog = false;
	}

	public function deleteSubDivision()
	{
		$group = NcoGroup::where('nco_sub_division_id', $this->subDivisionId)->first();
		$user = UserNco::where('sub_division_id', $this->subDivisionId)->first();
		$change = ChangeNco::where('sub_division_id', $this->subDivisionId)->first();

		if (!$group && !$user && !$change) {
			NcoSubDivision::findOrFail($this->subDivisionId)->delete();
		} else {
			session()->flash('error', 'Permission denied! Sub division is used in another data.');
		}

		$this->deleteDialog = false;
	}

	public function hydrate()
	{
		$this->resetValidation();
	}

	public function render()
	{
		return view('livewire.admin.controls.nco.subdivision', [
			'subdivision' => NcoSubDivision::when($this->divis, fn ($q) => $q->where('nco_division_id', $this->divis))
				->when(
					$this->name,
					fn ($q) =>
					$q->where('name', 'like', '%' . $this->name . '%')
						->orWhere('code', 'like', '%' . $this->name . '%')
				)
				->paginate(10),
			'divisions' => NcoDivision::orderBy('name', 'ASC')->get(),
		]);
	}
}
