<?php

namespace App\Http\Livewire\Admin\Verify;

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
	public $infoId;
	public $userId;

	public $checkData = [];
	public $checkDataForStore = [];
	public $checkFamilyDataForStore = [];
	public $ncoList;

	public $showNcoDetails = false;
	public $allNcoDetails = [];

	public $detailSelected = [];
	public $showNcoCard = false;
	public $ncoCodeToDisplayOnCard;

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

	public function saveData($family, $dt)
	{
		$nco = new UserNco();
		$nco->user_id = $this->userId;
		$nco->division_id = $family->group->subdivision->division->id;
		$nco->family_id = $family->id;
		$nco->detail_id = $dt;
		$nco->sub_division_id = $family->group->subdivision->id;
		$nco->group_id = $family->group->id;

		if ($dt == $this->ncoCodeToDisplayOnCard) {
			$nco->nco_code_display = $this->ncoCodeToDisplayOnCard;
		}

		$nco->save();
	}

	public function saveAndNext()
	{
		$this->validate([
			'ncoCodeToDisplayOnCard' => 'required'
		]);

		UserNco::where('user_id', $this->userId)->delete();

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
			$nco->user_id = $this->userId;
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

		if (auth()->guard('admin')->user()->role_id == '1') {
			return redirect(route('admin.view.verify.application', $this->infoId));
		} elseif (auth()->guard('admin')->user()->role_id == '5') {
			return redirect(route('district-admin.pending-application', $this->infoId));
		} elseif (auth()->guard('admin')->user()->role_id == '2') {
			return redirect(route('verifier.application', $this->infoId));
		} elseif (auth()->guard('admin')->user()->role_id == '3') {
			return redirect(route('approver.application', $this->infoId));
		}
	}

	public function mount($userId, $infoId)
	{
		$this->infoId = $infoId;
		$this->userId = $userId;
		$this->ncoList = NcoGroup::with(['family', 'subdivision' => function ($sub) {
			return $sub->with('division');
		}])->has('family')->get()->groupBy('subdivision.division.name')->toBase();

		$userNcoLists = UserNco::where('user_id', $this->userId)->has('detail')->orderBy('family_id', 'ASC')->get()->groupBy('family_id')->toArray();

		if (count($userNcoLists) > 0) {
			$this->ncoCodeToDisplayOnCard = UserNco::where('user_id', $this->userId)->where('detail_id', '!=', null)->where('nco_code_display', '!=', null)->pluck('nco_code_display')->first();
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
	}

	public function hydrate()
	{
		$this->emit('select2AutoInit');
	}

	public function render()
	{
		return view('livewire.admin.verify.nco-selection');
	}
}
