<?php

namespace App\Http\Livewire\Admin\Controls\Nco;

use App\Models\ChangeNco;
use App\Models\NcoDetail;
use App\Models\NcoFamily;
use App\Models\UserNco;
use Livewire\Component;
use Livewire\WithPagination;

class Detail extends Component
{
	use WithPagination;

	public $family;
	public $detailName;
	public $detailCode;
	public $nco2004;
	public $detailId;
	public $addDialog = false;
	public $updateDialog = false;
	public $deleteDialog = false;
	public $name;
	public $fami;

	public function resetForm()
	{
		$this->reset([
			'family',
			'detailName',
			'detailCode',
			'nco2004',
			'detailId',
		]);
	}

	public function openAddDialog()
	{
		$this->resetForm();
		$this->addDialog = true;
	}

	public function addDetail()
	{
		$this->validate([
			'detailName' => 'required',
			'detailCode' => 'required',
			'family' => 'required',
			'nco2004' => 'required'
		]);

		$fam = new NcoDetail();
		$fam->name = $this->detailName;
		$fam->code = $this->detailCode;
		$fam->nco_2004 = $this->nco2004;
		$fam->nco_family_id = $this->family;
		$fam->save();
		$this->addDialog = false;
	}

	public function openUpdateDialog($id, $name, $code, $famId, $nco_2004)
	{
		$this->updateDialog = true;
		$this->family = $famId;
		$this->detailId = $id;
		$this->detailName = $name;
		$this->detailCode = $code;
		$this->nco2004 = $nco_2004;
	}

	public function updateDetail()
	{
		$this->validate([
			'detailName' => 'required',
			'detailCode' => 'required',
			'family' => 'required',
			'nco2004' => 'required'
		]);

		$fam = NcoDetail::findOrFail($this->detailId);
		$fam->name = $this->detailName;
		$fam->code = $this->detailCode;
		$fam->nco_2004 = $this->nco2004;
		$fam->nco_family_id = $this->family;
		$fam->save();
		$this->updateDialog = false;
	}

	public function openDeleteDialog($id)
	{
		$this->detailId = $id;
		$this->deleteDialog = true;
	}

	public function closeDeleteDialog()
	{
		$this->resetForm();
		$this->deleteDialog = false;
	}

	public function deleteFamily()
	{
		$user = UserNco::where('detail_id', $this->detailId)->first();
		$change = ChangeNco::where('detail_id', $this->detailId)->first();

		if (!$user && !$change) {
			NcoDetail::findOrFail($this->detailId)->delete();
		} else {
			session()->flash('error', 'Permission denied! Detail/Occupation is used in another data.');
		}

		$this->deleteDialog = false;
	}

	public function hydrate()
	{
		$this->resetValidation();
	}

	public function render()
	{
		return view('livewire.admin.controls.nco.detail', [
			'families' => NcoFamily::orderBy('name', 'ASC')->get(),
			'details' => NcoDetail::when($this->fami, fn ($q) => $q->where('nco_family_id', $this->fami))
				->when(
					$this->name,
					fn ($q) =>
					$q->where('name', 'like', '%' . $this->name . '%')
						->orWhere('code', 'like', '%' . $this->name . '%')
						->orWhere('nco_2004', 'like', '%' . $this->name . '%')
				)
				->paginate(10),
		]);
	}
}
