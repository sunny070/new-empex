<?php

namespace App\Http\Livewire\Verifier\Change;

use App\Jobs\SendStatusSms;
use App\Models\ChangeEducation;
use App\Models\EducationQualification;
use App\Models\OnGoingApplication;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Education extends Component
{
	public $user;
	public $userId;
	public $changeEducations;
	public $original;
	public $compare = false;
	public $verifyDialog = false;
	public $rejectDialog = false;
	public $rejectionNote;
	public $originalDocs = [];

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
		$educations = ChangeEducation::where('user_id', $this->userId)->get();
		foreach ($educations as $edu) {
			Storage::disk('public')->delete($edu->certificate);
			$edu->delete();
		}

		$ongoing = OnGoingApplication::where('type', 'Change request - Education Details')->where('model_name', 'EducationQualification')->where('user_id', $this->userId)->first();
		$ongoing->verified_date = today();
		$ongoing->rejected_date = today();
		$ongoing->status = 'Rejected';
		$ongoing->rejection_note = $this->rejectionNote;
		$ongoing->save();

		SendStatusSms::dispatch($this->user->mobile_no, 'change educational details', 'rejected')->delay(30);

		return redirect(route('verifier.change'));
	}

	public function verifyChange()
	{
		$ongoing = OnGoingApplication::where('type', 'Change request - Education Details')->where('model_name', 'EducationQualification')->where('user_id', $this->userId)->first();
		$ongoing->verified_date = today();
		$ongoing->status = 'Verified';
		$ongoing->save();

		SendStatusSms::dispatch($this->user->mobile_no, 'change educational details', 'verified')->delay(30);

		$educations = ChangeEducation::where('user_id', $this->userId)->get();
		foreach ($educations as $education) {
			$edu = ChangeEducation::findOrFail($education->id);
			$edu->status = 'Verified';
			$edu->save();
		}

		return redirect(route('verifier.change'));
	}

	public function mount($userId)
	{
		$this->userId = $userId;
		$this->user = User::where('id', $userId)->first();

		$this->changeEducations = ChangeEducation::where('user_id', $userId)->get();

		$this->original = EducationQualification::where('user_id', $userId)->get();

		foreach ($this->original as $ori) {
			$this->originalDocs[] = $ori->certificate;
		}
	}

	public function render()
	{
		return view('livewire.verifier.change.education');
	}
}
