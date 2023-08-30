<?php

namespace App\Http\Livewire\Admin\Controls\Nco;

use App\Models\ChangeNco;
use App\Models\JobNco;
use App\Models\NcoDetail;
use App\Models\NcoFamily;
use App\Models\NcoGroup;
use App\Models\UserNco;
use Livewire\Component;
use Livewire\WithPagination;

class Family extends Component
{
	use WithPagination;

	public $group;
	public $familyName;
	public $familyCode;
	public $familyId;
	public $addDialog = false;
	public $updateDialog = false;
	public $deleteDialog = false;
	public $name;
	public $grps;


	public function resetForm()
	{
		$this->reset([
			'group',
			'familyName',
			'familyCode',
			'familyId',
		]);
	}

	public function openAddDialog()
	{
		$this->resetForm();
		$this->addDialog = true;
	}

	public function addFamily()
	{
		$this->validate([
			'familyName' => 'required',
			'familyCode' => 'required',
			'group' => 'required'
		]);

		$fam = new NcoFamily();
		$fam->name = $this->familyName;
		$fam->code = $this->familyCode;
		$fam->nco_group_id = $this->group;
		$fam->save();
		$this->addDialog = false;
	}

	public function openUpdateDialog($id, $name, $code, $groupId)
	{
		$this->updateDialog = true;
		$this->group = $groupId;
		$this->familyId = $id;
		$this->familyName = $name;
		$this->familyCode = $code;
	}

	public function updateFamily()
	{
		$this->validate([
			'familyName' => 'required',
			'familyCode' => 'required',
			'group' => 'required'
		]);

		$fam = NcoFamily::findOrFail($this->familyId);
		$fam->name = $this->familyName;
		$fam->code = $this->familyCode;
		$fam->nco_group_id = $this->group;
		$fam->save();
		$this->updateDialog = false;
	}

	public function openDeleteDialog($id)
	{
		$this->familyId = $id;
		$this->deleteDialog = true;
	}

	public function closeDeleteDialog()
	{
		$this->resetForm();
		$this->deleteDialog = false;
	}

	public function deleteFamily()
	{
		$det = NcoDetail::where('nco_family_id', $this->familyId)->first();
		$user = UserNco::where('family_id', $this->familyId)->first();
		$change = ChangeNco::where('family_id', $this->familyId)->first();
		$job = JobNco::where('nco_family_id', $this->familyId)->first();

		if (!$det && !$user && !$change && !$job) {
			NcoFamily::findOrFail($this->familyId)->delete();
		} else {
			session()->flash('error', 'Permission denied! Family is used in another data.');
		}

		$this->deleteDialog = false;
	}

	public function hydrate()
	{
		$this->resetValidation();
	}

	public function render()
	{
		return view('livewire.admin.controls.nco.family', [
			'families' => NcoFamily::when($this->grps, fn ($q) => $q->where('nco_group_id', $this->grps))
				->when(
					$this->name,
					fn ($q) =>
					$q->where('name', 'like', '%' . $this->name . '%')
						->orWhere('code', 'like', '%' . $this->name . '%')
				)
				->paginate(10),
			'groups' => NcoGroup::orderBy('name', 'ASC')->get(),
		]);
	}
}
