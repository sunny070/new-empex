<?php

namespace App\Http\Livewire\Verifier\Change;

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
	public $verifyDialog = false;
	public $rejectDialog = false;
	public $rejectionNote;

	public function goBack()
	{
		return redirect(route('verifier.change'));
	}

	public function compare()
	{
		$this->compare = !$this->compare;
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
		ChangeAddress::where('user_id', $this->userId)->delete();

		$ongoing = OnGoingApplication::where('type', 'Change request - Address')->where('model_name', 'Address')->where('user_id', $this->userId)->first();
		$ongoing->verified_date = today();
		$ongoing->rejected_date = today();
		$ongoing->status = 'Rejected';
		$ongoing->rejection_note = $this->rejectionNote;
		$ongoing->save();

		SendStatusSms::dispatch($this->user->mobile_no, 'change address', 'rejected')->delay(30);

		return redirect(route('verifier.change'));
	}

	public function verifyChange()
	{
		$ongoing = OnGoingApplication::where('type', 'Change request - Address')->where('model_name', 'Address')->where('user_id', $this->userId)->first();
		$ongoing->verified_date = today();
		$ongoing->status = 'Verified';
		$ongoing->save();

		SendStatusSms::dispatch($this->user->mobile_no, 'change address', 'verified')->delay(30);

		$addresses = ChangeAddress::where('user_id', $this->userId)->get();

		foreach ($addresses as $address) {
			$ad = ChangeAddress::findOrFail($address->id);
			$ad->status = 'Verified';
			$ad->save();
		}

		return redirect(route('verifier.change'));
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
		return view('livewire.verifier.change.address');
	}
}
