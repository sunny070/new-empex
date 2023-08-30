<?php

namespace App\Http\Livewire\Approver\Change;

use App\Jobs\SendStatusSms;
use App\Models\BasicInfo;
use App\Models\ChangeBasicInfo;
use App\Models\ChangeUserCanRead;
use App\Models\ChangeUserCanSpeak;
use App\Models\ChangeUserCanWrite;
use App\Models\ChangeUserPhysicalChallenge;
use App\Models\OnGoingApplication;
use App\Models\User;
use App\Models\UserCanRead;
use App\Models\UserCanSpeak;
use App\Models\UserCanWrite;
use App\Models\UserPhysicalChallenge;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Info extends Component
{
	public $changeInfo;
	public $original;
	public $compare = false;
	public $approveDialog = false;
	public $rejectDialog = false;
	public $requested_id;
	public $user;
	public $rejectionNote;
	public $changeReadLanguage;
	public $changeWriteLanguage;
	public $changeSpokenLanguage;
	public $changePhysicallyChallenge;
	public $oriReadLanguage;
	public $oriWriteLanguage;
	public $oriSpokenLanguage;
	public $oriPhysicallyChallenge;

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
		$info = ChangeBasicInfo::findOrFail($this->requested_id)->first();
		if ($this->original->avatar != $info->avatar) {
			Storage::disk('public')->delete($info->avatar);
		}
		$info->delete();

		$ongoing = OnGoingApplication::where('type', 'Change request - Basic info')->where('model_name', 'BasicInfo')->where('requested_id', $this->requested_id)->where('user_id', $this->changeInfo->user_id)->first();
		$ongoing->verified_date = today();
		$ongoing->rejected_date = today();
		$ongoing->status = 'Rejected';
		$ongoing->rejection_note = $this->rejectionNote;
		$ongoing->save();

		ChangeUserCanRead::where('user_id', $this->changeInfo->user_id)->delete();
		ChangeUserCanSpeak::where('user_id', $this->changeInfo->user_id)->delete();
		ChangeUserCanWrite::where('user_id', $this->changeInfo->user_id)->delete();
		ChangeUserPhysicalChallenge::where('user_id', $this->changeInfo->user_id)->delete();

		SendStatusSms::dispatch($this->user->mobile_no, 'change basic info', 'rejected')->delay(30);

		return redirect(route('approver.change'));
	}

	public function approveChange()
	{
		OnGoingApplication::where('type', 'Change request - Basic info')->where('status', '!=', 'Rejected')->where('model_name', 'BasicInfo')->where('requested_id', $this->requested_id)->where('user_id', $this->changeInfo->user_id)->delete();

		SendStatusSms::dispatch($this->user->mobile_no, 'change basic info', 'approved')->delay(30);

		$basic = BasicInfo::where('user_id', $this->changeInfo->user_id)->first();
		if ($basic->avatar != $this->changeInfo->avatar) {
			Storage::disk('public')->delete($basic->avatar);
		}
		$basic->avatar = $this->changeInfo->avatar;
		$basic->full_name = $this->changeInfo->full_name;
		$basic->dob = $this->changeInfo->dob;
		$basic->gender = $this->changeInfo->gender;
		$basic->phone_no = $this->changeInfo->phone_no;
		$basic->parents_name = $this->changeInfo->parents_name;
		$basic->religion_id = $this->changeInfo->religion_id;
		$basic->caste = $this->changeInfo->caste;
		$basic->marital_status = $this->changeInfo->marital_status;
		$basic->physically_challenge = $this->changeInfo->physically_challenge;
		$basic->society = $this->changeInfo->society;
		$basic->aadhar_no = $this->changeInfo->aadhar_no;
		$basic->full_name = $this->changeInfo->full_name;
		$basic->save();

		$user = User::where('id', $basic->user_id)->first();
		$user->name = $basic->full_name;
		$user->mobile_no = $basic->phone_no;
		$user->save();

		UserCanRead::where('user_id', $this->changeInfo->user_id)->delete();
		$changeUserRead = ChangeUserCanRead::where('user_id', $this->changeInfo->user_id)->get();
		foreach ($changeUserRead as $read) {
			$bRead = new UserCanRead();
			$bRead->user_id = $read->user_id;
			$bRead->language_id = $read->language_id;
			$bRead->save();
		}

		UserCanWrite::where('user_id', $this->changeInfo->user_id)->delete();
		$changeUserWrite = ChangeUserCanWrite::where('user_id', $this->changeInfo->user_id)->get();
		foreach ($changeUserWrite as $write) {
			$bWrite = new UserCanWrite();
			$bWrite->user_id = $write->user_id;
			$bWrite->language_id = $write->language_id;
			$bWrite->save();
		}

		UserCanSpeak::where('user_id', $this->changeInfo->user_id)->delete();
		$changeUserSpeak = ChangeUserCanSpeak::where('user_id', $this->changeInfo->user_id)->get();
		foreach ($changeUserSpeak as $speak) {
			$bSpeak = new UserCanSpeak();
			$bSpeak->user_id = $speak->user_id;
			$bSpeak->language_id = $speak->language_id;
			$bSpeak->save();
		}

		UserPhysicalChallenge::where('user_id', $this->changeInfo->user_id)->delete();
		$changeUserPhysical = ChangeUserPhysicalChallenge::where('user_id', $this->changeInfo->user_id)->get();
		foreach ($changeUserPhysical as $phy) {
			$bPhy = new UserPhysicalChallenge();
			$bPhy->user_id = $phy->user_id;
			$bPhy->physical_challenge_id = $phy->physical_challenge_id;
			$bPhy->save();
		}

		ChangeBasicInfo::findOrFail($this->requested_id)->delete();

		return redirect(route('approver.change'));
	}

	public function mount($id)
	{
		$this->requested_id = $id;
		$this->changeInfo = ChangeBasicInfo::with('religion')->findOrFail($id);
		$this->original = BasicInfo::with('religion')->where('user_id', $this->changeInfo->user_id)->first();
		$this->user = User::where('id', $this->changeInfo->user_id)->first();

		$this->changeReadLanguage = ChangeUserCanRead::with('language')->where('user_id', $this->changeInfo->user_id)->get();
		$this->changeWriteLanguage = ChangeUserCanWrite::with('language')->where('user_id', $this->changeInfo->user_id)->get();
		$this->changeSpokenLanguage = ChangeUserCanSpeak::with('language')->where('user_id', $this->changeInfo->user_id)->get();
		$this->changePhysicallyChallenge = ChangeUserPhysicalChallenge::with('physicalChallenge')->where('user_id', $this->changeInfo->user_id)->get();

		$this->oriReadLanguage = UserCanRead::with('language')->where('user_id', $this->changeInfo->user_id)->get();
		$this->oriWriteLanguage = UserCanWrite::with('language')->where('user_id', $this->changeInfo->user_id)->get();
		$this->oriSpokenLanguage = UserCanSpeak::with('language')->where('user_id', $this->changeInfo->user_id)->get();
		$this->oriPhysicallyChallenge = UserPhysicalChallenge::with('physicalChallenge')->where('user_id', $this->changeInfo->user_id)->get();
	}

	public function render()
	{
		return view('livewire.approver.change.info');
	}
}
