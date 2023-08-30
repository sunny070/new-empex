<?php

namespace App\Http\Livewire\Admin\ChangeRequest;

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
	public $approveDialog = false;
	public $rejectDialog = false;
	public $rejectionNote;

	public function goBack()
	{
		return redirect(route('admin.approve.change.request'));
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
		ChangeExperience::where('user_id', $this->userId)->delete();

		$ongoing = OnGoingApplication::where('type', 'Change request - Experiences')->where('model_name', 'Experience')->where('user_id', $this->userId)->first();
		$ongoing->verified_date = today();
		$ongoing->rejected_date = today();
		$ongoing->status = 'Rejected';
		$ongoing->rejection_note = $this->rejectionNote;
		$ongoing->save();

		SendStatusSms::dispatch($this->user->mobile_no, 'change experiences', 'rejected')->delay(30);

		return redirect(route('admin.approve.change.request'));
	}

	public function approveChange()
	{
		OnGoingApplication::where('type', 'Change request - Experiences')->where('status', '!=', 'Rejected')->where('model_name', 'Experience')->where('user_id', $this->userId)->delete();

		SendStatusSms::dispatch($this->user->mobile_no, 'change experiences', 'approved')->delay(30);

		ModelsExperience::where('user_id', $this->userId)->delete();

		foreach ($this->changeExperiences as $change) {
			$exp = new ModelsExperience();
			$exp->user_id = $change->user_id;
			$exp->designation = $change->designation;
			$exp->from = $change->from;
			$exp->to = $change->to;
			$exp->company = $change->company;
			$exp->total_emoluments = $change->total_emoluments;
			$exp->leave_reason = $change->leave_reason;
			$exp->is_working = $change->is_working;
			$exp->save();
		}

		ChangeExperience::where('user_id', $this->userId)->delete();

		return redirect(route('admin.approve.change.request'));
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
		return view('livewire.admin.change-request.experience');
	}
}
