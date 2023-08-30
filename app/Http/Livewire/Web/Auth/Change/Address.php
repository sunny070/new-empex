<?php

namespace App\Http\Livewire\Web\Auth\Change;

use App\Jobs\SendStatusSms;
use App\Models\Address as ModelsAddress;
use App\Models\BasicInfo;
use App\Models\ChangeAddress;
use App\Models\District;
use App\Models\OnGoingApplication;
use App\Models\PoliceStation;
use App\Models\PostOffice;
use App\Models\RdBlock;
use App\Models\State;
use Livewire\Component;

class Address extends Component
{
	public $allStates;
	public $allDistricts;
	public $allLocalities;
	public $allRdBlock;
	public $allPoliceStation;
	public $allPostOffice;

	public $presentAllStates;
	public $presentAllDistricts;

	public $permanentState = null;
	public $permanentDistrict = null;
	public $permanentLocality = null;
	public $permanentRdBlock = null;
	public $permanentPoliceStation = null;
	public $permanentPostOffice = null;
	public $permanentPincode = null;
	public $permanentHouseNo = null;

	public $presentState = null;
	public $presentDistrict = null;
	public $presentLocality = null;
	public $presentRdBlock = null;
	public $presentPoliceStation = null;
	public $presentPostOffice = null;
	public $presentPincode = null;
	public $presentHouseNo = null;

	public $sameAsPermanent = true;

	public $buttonDisable = false;
	public $canChange = true;
	public $sameDistrict = null;

	public function updatedPermanentState($state)
	{
		$this->allDistricts = District::where('state_id', $state)->get();
	}

	public function updatedPresentState($state)
	{
		$this->presentAllDistricts = District::where('state_id', $state)->get();
	}

	public function updatedSameAsPermanent()
	{
		if ($this->sameAsPermanent == true) {
			$this->reset(
				'presentState',
				'presentDistrict',
				'presentLocality',
				'presentRdBlock',
				'presentPoliceStation',
				'presentPostOffice',
				'presentPincode',
				'presentHouseNo',
			);
		}
	}

	public function submit()
	{
		$this->validate([
			'permanentState' => 'required',
			'permanentDistrict' => 'required',
			'permanentLocality' => 'required',
			'permanentRdBlock' => 'required',
			'permanentPoliceStation' => 'required',
			'permanentPostOffice' => 'required',
			'permanentPincode' => 'required',
			'permanentHouseNo' => 'required',
			'presentState' => 'required_if:sameAsPermanent,false',
			'presentDistrict' => 'required_if:sameAsPermanent,false',
			'presentLocality' => 'required_if:sameAsPermanent,false',
			'presentRdBlock' => 'required_if:sameAsPermanent,false',
			'presentPoliceStation' => 'required_if:sameAsPermanent,false',
			'presentPostOffice' => 'required_if:sameAsPermanent,false',
			'presentPincode' => 'required_if:sameAsPermanent,false',
			'presentHouseNo' => 'required_if:sameAsPermanent,false',
		]);

		if (!$this->sameAsPermanent) {
			$presentAddress = ChangeAddress::firstOrNew(['user_id' => auth()->id(), 'type' => 'present']);
			$presentAddress->user_id = auth()->id();
			$presentAddress->state_id = $this->presentState;
			$presentAddress->district_id = $this->presentDistrict;
			$presentAddress->village = $this->presentLocality;
			$presentAddress->pin_code = $this->presentPincode;
			$presentAddress->police_station_id = $this->presentPoliceStation;
			$presentAddress->post_office_id = $this->presentPostOffice;
			$presentAddress->rd_block_id = $this->presentRdBlock;
			$presentAddress->house_no = $this->presentHouseNo;
			$presentAddress->type = 'present';
			$presentAddress->user_district_id = BasicInfo::where('user_id', auth()->id())->latest('updated_at')->value('district_id');
			$presentAddress->save();
		} else {
			ChangeAddress::where('user_id', auth()->id())->where('type', 'present')->delete();
		}

		$address = ChangeAddress::firstOrNew(['user_id' => auth()->id(), 'type' => 'permanent']);
		$address->user_id = auth()->id();
		$address->state_id = $this->permanentState;
		$address->district_id = $this->permanentDistrict;
		$address->village = $this->permanentLocality;
		$address->pin_code = $this->permanentPincode;
		$address->house_no = $this->permanentHouseNo;
		$address->police_station_id = $this->permanentPoliceStation;
		$address->post_office_id = $this->permanentPostOffice;
		$address->rd_block_id = $this->permanentRdBlock;
		$address->type = 'permanent';
		$address->user_district_id = BasicInfo::where('user_id', auth()->id())->latest('updated_at')->value('district_id');
		$address->save();

		$ongoing = new OnGoingApplication();
		$ongoing->user_id = auth()->id();
		$ongoing->type = 'Change request - Address';
		$ongoing->model_name = 'Address';
		$ongoing->requested_id = $address->id;
		$ongoing->status = 'Pending';
		$ongoing->color = '#ff7e0e';
		$ongoing->bg = '#fff5ef';
		$ongoing->save();

		SendStatusSms::dispatch(auth()->user()->mobile_no, 'change address', 'received')->delay(30);

		session()->flash('message', 'Change Requested submitted successfully!');
		return redirect(route('auth.employee.changerequest'));
	}

	public function mount()
	{
		$alreadySubmitted = ChangeAddress::where('user_id', auth()->id())->first();

		if ($alreadySubmitted) {
			$this->canChange = false;
		} else {
			$this->allStates = State::get();
			$this->allRdBlock = RdBlock::orderBy('name', 'ASC')->get();
			$this->allPoliceStation = PoliceStation::orderBy('name', 'ASC')->get();
			$this->allPostOffice = PostOffice::orderBy('name', 'ASC')->get();

			$userPermanent = ModelsAddress::with('state', 'district', 'rdBlock', 'policeStation', 'postOffice')->where('user_id', auth()->id())->where('type', 'permanent')->latest('updated_at')->first();

			if ($userPermanent) {
				$this->permanentState = $userPermanent->state_id;
				$this->permanentDistrict = $userPermanent->district_id;
				$this->permanentLocality = $userPermanent->village;
				$this->permanentRdBlock = $userPermanent->rd_block_id;
				$this->permanentPoliceStation = $userPermanent->police_station_id;
				$this->permanentPostOffice = $userPermanent->post_office_id;
				$this->permanentPincode = $userPermanent->pin_code;
				$this->permanentHouseNo = $userPermanent->house_no;
				$this->allDistricts = District::where('state_id', $userPermanent->state_id)->get();
			} else {
				$this->allDistricts = collect();
			}

			$userPresent = ModelsAddress::with('state', 'district', 'rdBlock', 'policeStation', 'postOffice')->where('user_id', auth()->id())->where('type', 'present')->latest('updated_at')->first();

			if ($userPresent) {
				$this->presentState = $userPresent->state_id;
				$this->presentDistrict = $userPresent->district_id;
				$this->presentLocality = $userPresent->village;
				$this->presentRdBlock = $userPresent->rd_block_id;
				$this->presentPoliceStation = $userPresent->police_station_id;
				$this->presentPostOffice = $userPresent->post_office_id;
				$this->presentPincode = $userPresent->pin_code;
				$this->presentHouseNo = $userPresent->house_no;
				$this->sameAsPermanent = false;

				$this->presentAllDistricts = District::where('state_id', $userPresent->state_id)->get();
			} else {
				$this->presentAllDistricts = collect();
			}
		}
	}

	public function hydrate()
	{
		$this->emit('select2AutoInit');
	}

	public function render()
	{
		return view('livewire.web.auth.change.address');
	}
}
