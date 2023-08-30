<?php

namespace App\Http\Livewire\Verifier\Change;

use App\Jobs\SendStatusSms;
use App\Models\Address;
use App\Models\OnGoingApplication;
use App\Models\Transfer as ModelsTransfer;
use Livewire\Component;

class Transfer extends Component
{
	public $transfer;
	public $origin;
	public $verifyDialog = false;
	public $rejectDialog = false;
	public $requested_id;
	public $user;
	public $rejectionNote;

	public function goBack()
	{
		return redirect(route('verifier.change'));
	}

	public function openVerifyDialog()
	{
		$this->verifyDialog = true;
	}

	public function closeVerifyDialog()
	{
		$this->verifyDialog = false;
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
		ModelsTransfer::findOrFail($this->requested_id)->delete();

		$ongoing = OnGoingApplication::where('type', 'Change request - Transfer')->where('status', '!=', 'Rejected')->where('model_name', 'Address')->where('requested_id', $this->requested_id)->where('user_id', $this->transfer->user->id)->first();
		$ongoing->verified_date = today();
		$ongoing->rejected_date = today();
		$ongoing->status = 'Rejected';
		$ongoing->rejection_note = $this->rejectionNote;
		$ongoing->save();

		SendStatusSms::dispatch($this->transfer->user->mobile_no, 'transfer request', 'rejected')->delay(30);

		return redirect(route('verifier.change'));
	}

	public function verifyChange()
	{
		$ongoing = OnGoingApplication::where('type', 'Change request - Transfer')->where('model_name', 'Address')->where('requested_id', $this->requested_id)->where('user_id', $this->transfer->user->id)->first();
		$ongoing->verified_date = today();
		$ongoing->status = 'Verified';
		$ongoing->save();

		SendStatusSms::dispatch($this->transfer->user->mobile_no, 'transfer request', 'verified')->delay(30);

		$trans = ModelsTransfer::findOrFail($this->requested_id)->first();
		$trans->status = 'Verified';
		$trans->save();

		return redirect(route('verifier.change'));
	}

	public function mount($id)
	{
		$this->requested_id = $id;
		$this->transfer = ModelsTransfer::with('user', 'state', 'district', 'rdBlock', 'policeStation', 'postOffice')->findOrFail($id);

		$this->origin = Address::where('user_id', $this->transfer->user->id)->where('type', 'present')->first();
		if ($this->origin == null) {
			$this->origin = Address::where('user_id', $this->transfer->user->id)->where('type', 'permanent')->first();
		}
	}

	public function render()
	{
		return view('livewire.verifier.change.transfer');
	}
}
