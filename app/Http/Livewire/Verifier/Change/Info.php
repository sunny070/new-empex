<?php

namespace App\Http\Livewire\Verifier\Change;

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
	public $verifyDialog = false;
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

		return redirect(route('verifier.change'));
	}

	public function verifyChange()
	{
		$ongoing = OnGoingApplication::where('type', 'Change request - Basic info')->where('model_name', 'BasicInfo')->where('requested_id', $this->requested_id)->where('user_id', $this->changeInfo->user_id)->first();
		$ongoing->verified_date = today();
		$ongoing->status = 'Verified';
		$ongoing->save();

		SendStatusSms::dispatch($this->user->mobile_no, 'change basic info', 'verified')->delay(30);

		$info = ChangeBasicInfo::findOrFail($this->requested_id)->first();
		$info->status = 'Verified';
		$info->save();

		return redirect(route('verifier.change'));
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
		return view('livewire.verifier.change.info');
	}
}
