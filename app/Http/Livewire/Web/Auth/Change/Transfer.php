<?php

namespace App\Http\Livewire\Web\Auth\Change;

use App\Jobs\SendStatusSms;
use App\Models\Address;
use App\Models\BasicInfo;
use App\Models\District;
use App\Models\OnGoingApplication;
use App\Models\PoliceStation;
use App\Models\PostOffice;
use App\Models\RdBlock;
use App\Models\State;
use App\Models\Transfer as ModelsTransfer;
use Livewire\Component;

class Transfer extends Component
{
	public $allStates;
	public $allDistricts;
	public $allLocalities;
	public $allRdBlock;
	public $allPoliceStation;
	public $allPostOffice;

	public $state = null;
	public $district = null;
	public $locality = null;
	public $rdBlock = null;
	public $policeStation = null;
	public $postOffice = null;
	public $pincode = null;
	public $houseNo = null;

	public $buttonDisable = false;
	public $canChange = true;
	public $sameDistrict = null;

	public function updatedState($state)
	{
		$this->allDistricts = District::where('state_id', $state)->get();
	}

	public function updatedDistrict($dist)
	{
		if ($dist != '') {
			$userDistrict = Address::where('user_id', auth()->id())->first()->value('district_id');
			if ($userDistrict == $dist) {
				$this->buttonDisable = true;
				$this->sameDistrict = 'Cannot transfer to same District';
			} else {
				$this->buttonDisable = false;
				$this->sameDistrict = null;
			}
		} else {
			$this->district = null;
		}
	}

	public function submit()
	{
		$this->validate([
			'state' => 'required',
			'district' => 'required',
			'locality' => 'required',
			'rdBlock' => 'required',
			'policeStation' => 'required',
			'postOffice' => 'required',
			'pincode' => 'required',
			'houseNo' => 'required'
		]);

		$address = new ModelsTransfer;
		$address->user_id = auth()->id();
		$address->state_id = $this->state;
		$address->district_id = $this->district;
		$address->police_station_id = $this->policeStation;
		$address->post_office_id = $this->postOffice;
		$address->rd_block_id = $this->rdBlock;
		$address->village = $this->locality;
		$address->pin_code = $this->pincode;
		$address->house_no = $this->houseNo;
		$address->user_district_id = BasicInfo::where('user_id', auth()->id())->latest('updated_at')->value('district_id');
		$address->save();

		$ongoing = new OnGoingApplication();
		$ongoing->user_id = auth()->id();
		$ongoing->type = 'Change request - Transfer';
		$ongoing->model_name = 'Address';
		$ongoing->requested_id = $address->id;
		$ongoing->status = 'Pending';
		$ongoing->color = '#ff7e0e';
		$ongoing->bg = '#fff5ef';
		$ongoing->save();

		SendStatusSms::dispatch(auth()->user()->mobile_no, 'transfer address', 'received')->delay(30);

		session()->flash('message', 'Change Requested submitted successfully!');
		return redirect(route('auth.employee.changerequest'));
	}

	public function mount()
	{
		$alreadySubmitted = ModelsTransfer::where('user_id', auth()->id())->first();

		if ($alreadySubmitted) {
			$this->canChange = false;
		} else {
			$this->allStates = State::get();
			$this->allRdBlock = RdBlock::orderBy('name', 'ASC')->get();
			$this->allPoliceStation = PoliceStation::orderBy('name', 'ASC')->get();
			$this->allPostOffice = PostOffice::orderBy('name', 'ASC')->get();
			$this->allDistricts = collect();
		}
	}

	public function hydrate()
	{
		$this->emit('select2AutoInit');
	}

	public function render()
	{
		return view('livewire.web.auth.change.transfer');
	}
}
