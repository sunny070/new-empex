<?php

namespace App\Http\Livewire\Admin\Controls\Nco;

use App\Models\ChangeNco;
use App\Models\NcoFamily;
use App\Models\NcoGroup;
use App\Models\NcoSubDivision;
use App\Models\UserNco;
use Livewire\Component;
use Livewire\WithPagination;

class Group extends Component
{
	use WithPagination;

	public $subdivision;
	public $groupName;
	public $groupCode;
	public $groupId;
	public $addDialog = false;
	public $updateDialog = false;
	public $deleteDialog = false;
	public $name;
	public $subdiv;

	public function resetForm()
	{
		$this->reset([
			'subdivision',
			'groupName',
			'groupCode',
			'groupId',
		]);
	}

	public function openAddDialog()
	{
		$this->resetForm();
		$this->addDialog = true;
	}

	public function addGroup()
	{
		$this->validate([
			'groupName' => 'required',
			'groupCode' => 'required',
			'subdivision' => 'required'
		]);

		$group = new NcoGroup();
		$group->name = $this->groupName;
		$group->code = $this->groupCode;
		$group->nco_sub_division_id = $this->subdivision;
		$group->nco_division_id = NcoSubDivision::where('id', $this->subdivision)->value('nco_division_id');
		$group->save();
		$this->addDialog = false;
	}

	public function openUpdateDialog($id, $name, $code, $subId)
	{
		$this->updateDialog = true;
		$this->subdivision = $subId;
		$this->groupId = $id;
		$this->groupName = $name;
		$this->groupCode = $code;
	}

	public function updateGroup()
	{
		$this->validate([
			'groupName' => 'required',
			'groupCode' => 'required',
			'subdivision' => 'required'
		]);

		$group = NcoGroup::findOrFail($this->groupId);
		$group->name = $this->groupName;
		$group->code = $this->groupCode;
		$group->nco_sub_division_id = $this->subdivision;
		$group->nco_division_id = NcoSubDivision::where('id', $this->subdivision)->value('nco_division_id');
		$group->save();
		$this->updateDialog = false;
	}

	public function openDeleteDialog($id)
	{
		$this->groupId = $id;
		$this->deleteDialog = true;
	}

	public function closeDeleteDialog()
	{
		$this->resetForm();
		$this->deleteDialog = false;
	}

	public function deleteGroup()
	{
		$fam = NcoFamily::where('nco_group_id', $this->groupId)->first();
		$user = UserNco::where('group_id', $this->groupId)->first();
		$change = ChangeNco::where('group_id', $this->groupId)->first();

		if (!$fam && !$user && !$change) {
			NcoGroup::findOrFail($this->groupId)->delete();
		} else {
			session()->flash('error', 'Permission denied! Group is used in another data.');
		}

		$this->deleteDialog = false;
	}

	public function hydrate()
	{
		$this->resetValidation();
	}

	public function render()
	{
		return view('livewire.admin.controls.nco.group', [
			'subdivisions' => NcoSubDivision::orderBy('name', 'ASC')->get(),
			'groups' => NcoGroup::when($this->subdiv, fn ($q) => $q->where('nco_sub_division_id', $this->subdiv))
				->when(
					$this->name,
					fn ($q) =>
					$q->where('name', 'like', '%' . $this->name . '%')
						->orWhere('code', 'like', '%' . $this->name . '%')
				)
				->paginate(10),
		]);
	}
}
