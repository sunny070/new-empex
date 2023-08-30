<?php

namespace App\Http\Livewire\Admin\Controls\Nco;

use App\Models\ChangeNco;
use App\Models\NcoDivision;
use App\Models\NcoGroup;
use App\Models\NcoSubDivision;
use App\Models\UserNco;
use Livewire\Component;
use Livewire\WithPagination;

class Division extends Component
{
	use WithPagination;

	public $divisionName;
	public $divisionCode;
	public $divisionId;
	public $addDialog = false;
	public $updateDialog = false;
	public $deleteDialog = false;
	public $name;

	public function openAddDialog()
	{
		$this->divisionName = null;
		$this->addDialog = true;
	}

	public function addDivision()
	{
		$this->validate([
			'divisionName' => 'required',
			'divisionCode' => 'required'
		]);

		$div = new NcoDivision();
		$div->name = $this->divisionName;
		$div->code = $this->divisionCode;
		$div->save();
		$this->addDialog = false;
	}

	public function openUpdateDialog($id, $name, $code)
	{
		$this->updateDialog = true;
		$this->divisionId = $id;
		$this->divisionName = $name;
		$this->divisionCode = $code;
	}

	public function updateDivision()
	{
		$this->validate([
			'divisionName' => 'required',
			'divisionCode' => 'required'
		]);

		$div = NcoDivision::findOrFail($this->divisionId);
		$div->name = $this->divisionName;
		$div->code = $this->divisionCode;
		$div->save();
		$this->updateDialog = false;
	}

	public function openDeleteDialog($id)
	{
		$this->divisionId = $id;
		$this->deleteDialog = true;
	}

	public function closeDeleteDialog()
	{
		$this->divisionId = null;
		$this->deleteDialog = false;
	}

	public function deleteDivision()
	{
		$sub = NcoSubDivision::where('nco_division_id', $this->divisionId)->first();
		$group = NcoGroup::where('nco_division_id', $this->divisionId)->first();
		$user = UserNco::where('division_id', $this->divisionId)->first();
		$change = ChangeNco::where('division_id', $this->divisionId)->first();

		if (!$sub && !$group && !$user && !$change) {
			NcoDivision::findOrFail($this->divisionId)->delete();
		} else {
			session()->flash('error', 'Permission denied! Division is used in another data.');
		}

		$this->deleteDialog = false;
	}

	public function hydrate()
	{
		$this->resetValidation();
	}

	public function render()
	{
		return view('livewire.admin.controls.nco.division', [
			'divisions' => NcoDivision::when(
				$this->name,
				fn ($q) =>
				$q->where('name', 'like', '%' . $this->name . '%')
					->orWhere('code', 'like', '%' . $this->name . '%')
			)
				->paginate(10),
		]);
	}
}
