<?php

namespace App\Http\Livewire\Verifier\Change;

use App\Jobs\SendStatusSms;
use App\Models\ChangeExperience;
use App\Models\Experience as ModelsExperience;
use App\Models\OnGoingApplication;
use App\Models\User;
use Livewire\Component;

class Experience extends Component
{
	public $user;
	public $userId;
	public $changeExperiences;
	public $original;
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
		ChangeExperience::where('user_id', $this->userId)->delete();

		$ongoing = OnGoingApplication::where('type', 'Change request - Experiences')->where('model_name', 'Experience')->where('user_id', $this->userId)->first();
		$ongoing->verified_date = today();
		$ongoing->rejected_date = today();
		$ongoing->status = 'Rejected';
		$ongoing->rejection_note = $this->rejectionNote;
		$ongoing->save();

		SendStatusSms::dispatch($this->user->mobile_no, 'change experiences', 'rejected')->delay(30);

		return redirect(route('verifier.change'));
	}

	public function verifyChange()
	{
		$ongoing = OnGoingApplication::where('type', 'Change request - Experiences')->where('model_name', 'Experience')->where('user_id', $this->userId)->first();
		$ongoing->verified_date = today();
		$ongoing->status = 'Verified	';
		$ongoing->save();

		SendStatusSms::dispatch($this->user->mobile_no, 'change experiences', 'verified')->delay(30);

		$experiences = ChangeExperience::where('user_id', $this->userId)->get();

		foreach ($experiences as $experience) {
			$exp = ChangeExperience::findOrFail($experience->id);
			$exp->status = 'Verified';
			$exp->save();
		}

		return redirect(route('verifier.change'));
	}

	public function mount($userId)
	{
		$this->userId = $userId;
		$this->user = User::where('id', $userId)->first();

		$this->original = ModelsExperience::where('user_id', $userId)->get();
		$this->changeExperiences = ChangeExperience::where('user_id', $userId)->get();
	}

	public function render()
	{
		return view('livewire.verifier.change.experience');
	}
}
