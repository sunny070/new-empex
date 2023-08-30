<?php

namespace App\Http\Livewire\Approver\Change;

use App\Jobs\SendStatusSms;
use App\Models\Address as ModelsAddress;
use App\Models\ChangeAddress;
use App\Models\OnGoingApplication;
use App\Models\User;
use Livewire\Component;

class Address extends Component
{
	public $user;
	public $userId;
	public $presentAddress;
	public $permanentAddress;
	public $presentOriginal;
	public $permanentOriginal;
	public $compare = false;
	public $approveDialog = false;
	public $rejectDialog = false;
	public $rejectionNote;

	public function goBack()
	{
		return redirect(route('approver.change'));
	}

	public function compare()
	{
		$this->compare = !$this->compare;
	}

	public function openApproveDialog()
	{
		$this->approveDialog = true;
	}

	public function closeApproveDialog()
	{
		$this->approveDialog = false;
	}

	public function openRejectDialog()
	{
		$this->rejectDialog = true;
	}

	public function closeRejectDialog()
	{
		$this->rejectDialog = false;
	}

	public function rejectChange()
	{
		ChangeAddress::where('user_id', $this->userId)->delete();

		$ongoing = OnGoingApplication::where('type', 'Change request - Address')->where('model_name', 'Address')->where('user_id', $this->userId)->first();
		$ongoing->verified_date = today();
		$ongoing->rejected_date = today();
		$ongoing->status = 'Rejected';
		$ongoing->rejection_note = $this->rejectionNote;
		$ongoing->save();

		SendStatusSms::dispatch($this->user->mobile_no, 'change address', 'rejected')->delay(30);

		return redirect(route('approver.change'));
	}

	public function approveChange()
	{
		OnGoingApplication::where('type', 'Change request - Address')->where('status', '!=', 'Rejected')->where('model_name', 'Address')->where('user_id', $this->userId)->delete();

		SendStatusSms::dispatch($this->user->mobile_no, 'change address', 'approved')->delay(30);

		ModelsAddress::where('user_id', $this->userId)->delete();

		$add = new ModelsAddress();
		$add->user_id = $this->permanentAddress->user_id;
		$add->state_id = $this->permanentAddress->state_id;
		$add->district_id = $this->permanentAddress->district_id;
		$add->police_station_id = $this->permanentAddress->police_station_id;
		$add->post_office_id = $this->permanentAddress->post_office_id;
		$add->rd_block_id = $this->permanentAddress->rd_block_id;
		$add->village = $this->permanentAddress->village;
		$add->pin_code = $this->permanentAddress->pin_code;
		$add->house_no = $this->permanentAddress->house_no;
		$add->type = $this->permanentAddress->type;
		$add->save();

		if ($this->presentAddress != null) {
			$add = new ModelsAddress();
			$add->user_id = $this->presentAddress->user_id;
			$add->state_id = $this->presentAddress->state_id;
			$add->district_id = $this->presentAddress->district_id;
			$add->village = $this->presentAddress->village;
			$add->pin_code = $this->presentAddress->pin_code;
			$add->house_no = $this->presentAddress->house_no;
			$add->type = $this->presentAddress->type;
			$add->police_station_id = $this->presentAddress->police_station_id;
			$add->post_office_id = $this->presentAddress->post_office_id;
			$add->rd_block_id = $this->presentAddress->rd_block_id;
			$add->save();
		}

		ChangeAddress::where('user_id', $this->userId)->delete();

		return redirect(route('approver.change'));
	}

	public function mount($userId)
	{
		$this->userId = $userId;
		$this->user = User::where('id', $userId)->first();

		$this->presentAddress = ChangeAddress::with('state', 'district', 'rdBlock', 'policeStation', 'postOffice')->where('user_id', $userId)->where('type', 'present')->first();

		$this->permanentAddress = ChangeAddress::with('state', 'district', 'rdBlock', 'policeStation', 'postOffice')->where('user_id', $userId)->where('type', 'permanent')->first();

		$this->presentOriginal = ModelsAddress::with('state', 'district', 'rdBlock', 'policeStation', 'postOffice')->where('user_id', $userId)->where('type', 'present')->first();

		$this->permanentOriginal = ModelsAddress::with('state', 'district', 'rdBlock', 'policeStation', 'postOffice')->where('user_id', $userId)->where('type', 'permanent')->first();
	}

	public function render()
	{
		return view('livewire.approver.change.address');
	}
}
