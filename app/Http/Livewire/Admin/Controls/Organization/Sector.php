<?php

namespace App\Http\Livewire\Admin\Controls\Organization;

use App\Models\JobPost;
use App\Models\Organization;
use App\Models\Sector as ModelsSector;
use Livewire\Component;
use Livewire\WithPagination;

class Sector extends Component
{
	use WithPagination;

	public $sectorName;
	public $sectorId;
	public $addDialog = false;
	public $updateDialog = false;
	public $deleteDialog = false;
	public $name;

	public function openAddDialog()
	{
		$this->sectorName = null;
		$this->addDialog = true;
	}
	public function openUpdateDialog($id, $name)
	{
		$this->updateDialog = true;
		$this->sectorId = $id;
		$this->sectorName = $name;
	}

	public function openDeleteDialog($id)
	{
		$this->sectorId = $id;
		$this->deleteDialog = true;
	}

	public function closeDeleteDialog()
	{
		$this->sectorId = null;
		$this->deleteDialog = false;
	}

	public function addSector()
	{
		$this->validate([
			'sectorName' => 'required',
		]);

		$state = new ModelsSector();
		$state->name = $this->sectorName;
		$state->save();
		$this->addDialog = false;
	}

	public function updateSector()
	{
		$this->validate([
			'sectorName' => 'required',
		]);

		$state = ModelsSector::findOrFail($this->sectorId);
		$state->name = $this->sectorName;
		$state->save();
		$this->updateDialog = false;
	}

	public function deleteSector()
	{
		$job = JobPost::where('sector_id', $this->sectorId)->first();
		$org = Organization::where('sector_id', $this->sectorId)->first();

		if (!$job && !$org) {
			ModelsSector::findOrFail($this->sectorId)->delete();
		} else {
			session()->flash('error', 'Permission denied! Sector is used in another data.');
		}

		$this->deleteDialog = false;
	}

	public function hydrate()
	{
		$this->resetValidation();
	}

	public function render()
	{
		return view('livewire.admin.controls.organization.sector', [
			'sectors' => ModelsSector::orderBy('name', 'ASC')
				->when($this->name, fn ($q) => $q->where('name', 'like', '%' . $this->name . '%'))
				->paginate(10),
		]);
	}
}
