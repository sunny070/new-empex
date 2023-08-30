<?php

namespace App\Http\Livewire\Web\Auth\Change;

use App\Jobs\SendStatusSms;
use App\Models\ChangeNco;
use App\Models\NcoDetail;
use App\Models\NcoDivision;
use App\Models\NcoFamily;
use App\Models\NcoGroup;
use App\Models\NcoSubDivision;
use App\Models\OnGoingApplication;
use App\Models\UserNco;
use Livewire\Component;

class Nco extends Component
{
	public $division;
	public $subdivision;
	public $group;
	public $family;
	public $detail;

	public $allDivisions;
	public $allSubDivisions;
	public $allGroups;
	public $allFamilies;
	public $allDetails;

	public $canChange = true;

	public function updatedDivision($div)
	{
		if ($div != '') {
			$this->allSubDivisions = NcoSubDivision::where('nco_division_id', $div)->get();
		} else {
			$this->division = null;
		}
		$this->subdivision = null;
		$this->group = null;
		$this->family = null;
		$this->detail = null;
	}

	public function updatedSubdivision($sub)
	{
		if ($sub != '') {
			$this->allGroups = NcoGroup::where('nco_sub_division_id', $sub)->get();
		} else {
			$this->subdivision = null;
		}
		$this->group = null;
		$this->family = null;
		$this->detail = null;
	}

	public function updatedGroup($grp)
	{
		if ($grp != '') {
			$this->allFamilies = NcoFamily::where('nco_group_id', $grp)->get();
		} else {
			$this->group = null;
		}
		$this->family = null;
		$this->detail = null;
	}

	public function updatedFamily($fam)
	{
		if ($fam != '') {
			$this->allDetails = NcoDetail::where('nco_family_id', $fam)->get();
		} else {
			$this->family = null;
		}
		$this->detail = null;
	}

	public function submit()
	{
		$this->validate([
			'division' => 'required',
			'subdivision' => 'required',
			'group' => 'required',
			'family' => 'required',
			'detail' => 'required',
		]);

		$nco = ChangeNco::firstOrNew(['user_id' => auth()->id()]);
		$nco->user_id = auth()->id();
		$nco->division_id = $this->division;
		$nco->sub_division_id = $this->subdivision;
		$nco->group_id = $this->group;
		$nco->family_id = $this->family;
		$nco->detail_id = $this->detail;
		$nco->save();

		$ongoing = new OnGoingApplication();
		$ongoing->user_id = auth()->id();
		$ongoing->type = 'Change request - NCO';
		$ongoing->model_name = 'UserNco';
		$ongoing->requested_id = $nco->id;
		$ongoing->status = 'Pending';
		$ongoing->color = '#ff7e0e';
		$ongoing->bg = '#fff5ef';
		$ongoing->save();

		SendStatusSms::dispatch(auth()->user()->mobile_no, 'change nco details', 'received')->delay(30);

		session()->flash('message', 'Change Requested submitted successfully!');
		return redirect(route('auth.dashboard'));
	}

	public function mount()
	{
		$alreadySubmitted = ChangeNco::where('user_id', auth()->id())->first();

		if ($alreadySubmitted) {
			$this->canChange = false;
		} else {
			$this->allDivisions = NcoDivision::get();

			$userNco = UserNco::where('user_id', auth()->id())->first();

			if ($userNco) {
				$this->allSubDivisions = NcoSubDivision::where('nco_division_id', $userNco->division_id)->get();
				$this->allGroups = NcoGroup::where('nco_sub_division_id', $userNco->sub_division_id)->get();
				$this->allFamilies = NcoFamily::where('nco_group_id', $userNco->group_id)->get();
				$this->allDetails = NcoDetail::where('nco_family_id', $userNco->family_id)->get();

				$this->division = $userNco->division_id;
				$this->subdivision = $userNco->sub_division_id;
				$this->group = $userNco->group_id;
				$this->family = $userNco->family_id;
				$this->detail = $userNco->detail_id;
			} else {
				$this->allSubDivisions = collect();
				$this->allGroups = collect();
				$this->allFamilies = collect();
				$this->allDetails = collect();
			}
		}
	}

	public function hydrate()
	{
		$this->emit('select2AutoInit');
	}

	public function render()
	{
		return view('livewire.web.auth.change.nco');
	}
}
