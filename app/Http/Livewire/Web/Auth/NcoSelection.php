<?php

namespace App\Http\Livewire\Web\Auth;

use App\Models\NcoDetail;
use App\Models\NcoFamily;
use App\Models\NcoGroup;
use App\Models\UserNco;
use Livewire\Component;

class NcoSelection extends Component
{
	public $division;
	public $subdivision;
	public $group;
	public $family;
	public $detail;

	public $checkData = [];
	public $checkDataForStore = [];
	public $checkFamilyDataForStore = [];
	public $ncoList;

	public $showNcoDetails = false;
	public $allNcoDetails = [];

	public $detailSelected = [];
	public $showNcoCard = false;
	public $ncoCodeToDisplayOnCard;

	public $ncoFamilies;
	public $isSelectAll = false;

	public function updatedCheckData()
	{
		$this->ncoCodeToDisplayOnCard = null;
		$this->allNcoDetails = [];
		$this->checkFamilyDataForStore = [];
		foreach ($this->checkData as $check) {
			$family = NcoFamily::where('id', $check)
				->with([
					'group' => function ($group) {
						return $group->with('division', 'subdivision');
					}
				])
				->first()
				->toArray();

			$detailsList = NcoDetail::where('nco_family_id', $check)->get()->toArray();
			$detail = [];
			if (count($detailsList) > 0) {
				foreach ($detailsList as $det) {
					$detail[] = [
						'id' => $det['id'],
						'name' => $det['name'],
						'code' => $det['code']
					];
				}
			}
			array_push($this->allNcoDetails, ['detail' => $detail, 'family' => $family, 'group' => $family['nco_group_id'], 'division' => $family['group']['division']['name']]);
			array_push($this->checkFamilyDataForStore, (string)$family['id']);
		}

		$this->showNcoDetails = true;
	}

	public function updatedCheckDataForStore()
	{
		$this->ncoCodeToDisplayOnCard = null;
	}

	public function back()
	{
		$this->emit('stepDecrement');
	}

	public function backToSelect()
	{
		$this->isSelectAll = false;
		$this->showNcoCard = false;
	}

	public function confirmAndSelectNco()
	{
		if (count($this->checkFamilyDataForStore) < 1) {
			session()->flash('error', 'Please select at least one NCO');
		} else {
			if (count($this->checkDataForStore) > 0) {
				$this->detailSelected = NcoDetail::whereIn('id', $this->checkDataForStore)->get();
				$this->showNcoCard = true;
			} else {
				session()->flash('error', 'Please check at least one NCO');
			}
		}
	}

	public function saveAndNext()
	{
		$this->validate([
			'ncoCodeToDisplayOnCard' => 'required'
		]);

		UserNco::where('user_id', auth()->id())->delete();

		if ($this->isSelectAll == true) {
			$ncoDetailAll = NcoDetail::with([
				'family' => function ($fam) {
					return $fam->with([
						'group' => function ($group) {
							return $group->with('subdivision');
						}
					]);
				}
			])
				->get();

			foreach ($ncoDetailAll as $det) {
				$nco = new UserNco();
				$nco->user_id = auth()->id();
				$nco->division_id = $det->family->group->subdivision->nco_division_id;
				$nco->family_id = $det->family->id;
				$nco->detail_id = $det->id;
				$nco->sub_division_id = $det->family->group->subdivision->id;
				$nco->group_id = $det->family->group->id;

				if ($det->id == $this->ncoCodeToDisplayOnCard) {
					$nco->nco_code_display = $this->ncoCodeToDisplayOnCard;
				}

				$nco->save();
			}
		} else {
			foreach ($this->checkDataForStore as $dataForStore) {
				$detail = NcoDetail::where('id', $dataForStore)
					->with([
						'family' => function ($fam) {
							return $fam->with([
								'group' => function ($group) {
									return $group->with('subdivision');
								}
							]);
						}
					])
					->first();

				$nco = new UserNco();
				$nco->user_id = auth()->id();
				$nco->division_id = $detail->family->group->subdivision->nco_division_id;
				$nco->family_id = $detail->family->id;
				$nco->detail_id = $dataForStore;
				$nco->sub_division_id = $detail->family->group->subdivision->id;
				$nco->group_id = $detail->family->group->id;

				if ($dataForStore == $this->ncoCodeToDisplayOnCard) {
					$nco->nco_code_display = $this->ncoCodeToDisplayOnCard;
				}

				$nco->save();
			}
		}

		$this->emit('stepIncrement');
	}

	public function mount()
	{
		$this->ncoList = NcoGroup::with('family', 'division')->has('family')->get()->groupBy('division.name')->toBase();

		$userNcoLists = UserNco::where('user_id', auth()->id())->has('detail')->orderBy('family_id', 'ASC')->get()->groupBy('family_id')->toArray();

		if (count($userNcoLists) > 0) {
			$this->ncoCodeToDisplayOnCard = UserNco::where('user_id', auth()->id())->where('detail_id', '!=', null)->where('nco_code_display', '!=', null)->pluck('nco_code_display')->first();
			foreach ($userNcoLists as $key => $value) {

				array_push($this->checkData, (string)$key); // pushed family id (key)

				foreach ($value as $data) {
					if ($data['detail_id'] !== null) {
						array_push($this->checkDataForStore, (string)$data['detail_id']);
					}
				}
			}

			foreach ($this->checkData as $check) {
				$family = NcoFamily::where('id', $check)
					->with([
						'group' => function ($group) {
							return $group->with('division', 'subdivision');
						}
					])
					->first()
					->toArray();

				$detailsList = NcoDetail::where('nco_family_id', $check)->get()->toArray();
				$detail = [];
				if (count($detailsList) > 0) {
					foreach ($detailsList as $det) {
						$detail[] = [
							'id' => $det['id'],
							'name' => $det['name'],
							'code' => $det['code']
						];
					}
				}
				array_push($this->allNcoDetails, ['detail' => $detail, 'family' => $family, 'group' => $family['nco_group_id'], 'division' => $family['group']['division']['name']]);
				array_push($this->checkFamilyDataForStore, (string)$family['id']);
			}
			$this->showNcoDetails = true;
		}

		$this->ncoFamilies = NcoFamily::orderBy('name', 'ASC')->get();
	}

	public function hydrate()
	{
		$this->emit('select2AutoInit');
	}

	public function render()
	{
		return view('livewire.web.auth.nco-selection');
	}

	public function selectAllNco()
	{
		$this->isSelectAll = true;
		$this->detailSelected = NcoDetail::get();
		// dd($this->detailSelected);
		$this->showNcoCard = true;
	}
}
