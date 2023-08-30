<?php

namespace App\Http\Livewire\District\Changes\Approval\Detail;

use App\Jobs\SendStatusSms;
use App\Models\ChangeEducation;
use App\Models\EducationQualification;
use App\Models\MajorCore;
use App\Models\OnGoingApplication;
use App\Models\Subject;
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
	public $approveDialog = false;
	public $rejectDialog = false;
	public $rejectionNote;
	public $originalDocs = [];

	public function goBack()
	{
		return redirect(route('district-admin.change.approval'));
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
		$educations = ChangeEducation::where('user_id', $this->userId)->get();
		foreach ($educations as $index => $edu) {
			Storage::disk('public')->delete($edu->certificate);
			$edu->delete();
		}

		$ongoing = OnGoingApplication::where('type', 'Change request - Education Details')->where('model_name', 'EducationQualification')->where('user_id', $this->userId)->first();
		$ongoing->verified_date = today();
		$ongoing->rejected_date = today();
		$ongoing->status = 'Rejected';
		$ongoing->rejection_note = $this->rejectionNote;
		$ongoing->save();

		SendStatusSms::dispatch($this->user->mobile_no, 'change educational details', 'rejected')->delay(now()->addSeconds(5));

		return redirect(route('district-admin.change.approval'));
	}

	public function approveChange()
	{
		OnGoingApplication::where('type', 'Change request - Education Details')->where('status', '!=', 'Rejected')->where('model_name', 'EducationQualification')->where('user_id', $this->userId)->delete();

		SendStatusSms::dispatch($this->user->mobile_no, 'change educational details', 'approved')->delay(now()->addSeconds(5));

		$educations = EducationQualification::where('user_id', $this->userId)->get();
		foreach ($educations as $edu) {
			Storage::disk('public')->delete($edu->certificate);
			$edu->delete();
		}

		foreach ($this->changeEducations as $change) {
			$edu = new EducationQualification();
			$edu->user_id = $change->user_id;
			$edu->school = $change->school;
			$edu->year_of_passing = $change->year_of_passing;
			$edu->division = $change->division;
			$edu->course_duration = $change->course_duration;
			$edu->certificate = $change->certificate;
			$edu->qualification_id = $change->qualification_id;

			if ($change->subject_id == null && $change->custom_subject !== null) {
				$sub = new Subject();
				$sub->name = $change->custom_subject;
				$sub->qualification_id = $change->qualification_id;
				$sub->save();
				$edu->subject_id = $sub->id;
			} else {
				$edu->subject_id = $change->subject_id;
			}

			if ($change->major_core_id == null && $change->custom_major_core !== null) {
				$core = new MajorCore();
				$core->name = $change->custom_major_core;
				if ($change->subject_id == null) {
					$core->subject_id = $sub->id;
				} else {
					$core->subject_id = $change->subject_id;
				}
				$core->save();
				$edu->major_core_id = $core->id;
			} else {
				$edu->major_core_id = $change->major_core_id;
			}
			$edu->save();
		}

		ChangeEducation::where('user_id', $this->userId)->delete();

		return redirect(route('district-admin.change.approval'));
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
		return view('livewire.district.changes.approval.detail.education');
	}
}
