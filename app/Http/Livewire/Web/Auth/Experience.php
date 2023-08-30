<?php

namespace App\Http\Livewire\Web\Auth;

use App\Models\BasicInfo;
use App\Models\Experience as ModelsExperience;
use Livewire\Component;

class Experience extends Component
{
	public $hasExperience = true;
	public $expText = 'Yes';

	public $workExperiences = [];
	public $userExperiences = [];

	public function toggleExperience()
	{
		if ($this->hasExperience == true) {
			$this->hasExperience = false;
			$this->expText = 'No';
		} else {
			$this->hasExperience = true;
			$this->expText = 'Yes';
		}
	}

	public function addMoreExperience()
	{
		$this->workExperiences[] = ['id' => null, 'designation' => null, 'durationFrom' => null, 'durationTo' => null, 'company' => null, 'total' => null, 'leaveReason' => null, 'is_working' => false];
	}

	public function removeExperience($id = null)
	{
		if (!is_null($id)) {
			ModelsExperience::findOrFail($id)->delete();
		}
		unset($this->workExperiences[array_key_last($this->workExperiences)]);
		$this->workExperiences = array_values($this->workExperiences);
	}

	public function currentlyWorking($index)
	{
		$this->workExperiences[$index]['durationTo'] = null;
		$this->workExperiences[$index]['is_working'] = !$this->workExperiences[$index]['is_working'];
		$this->workExperiences = array_values($this->workExperiences);
	}

	public function saveAndNext()
	{
		$info = BasicInfo::where('user_id', auth()->id())->latest('updated_at')->first();
		if ($this->hasExperience) {
			$this->validate([
				'workExperiences.*.designation' => 'required',
				'workExperiences.*.company' => 'required',
				'workExperiences.*.durationFrom' => 'required',
				'workExperiences.*.durationTo' => 'required_if:workExperiences.*.is_working,false',
				'workExperiences.*.total' => 'required',
			]);

			ModelsExperience::where('user_id', auth()->id())->delete();
			foreach ($this->workExperiences as $experience) {
				$userExp = new ModelsExperience;
				$userExp->user_id = auth()->id();
				$userExp->designation = $experience['designation'];
				$userExp->from = $experience['durationFrom'];
				$userExp->to = $experience['durationTo'];
				$userExp->company = $experience['company'];
				$userExp->total_emoluments = $experience['total'];
				$userExp->leave_reason = $experience['leaveReason'];
				$userExp->is_working = $experience['is_working'] == true ? 1 : 0;
				$userExp->save();
			}


			$info->experienced = 1;
		}
		$info->percent_complete = '80';
		$info->save();

		$this->emit('stepIncrement');
	}

	public function back()
	{
		$this->emit('stepDecrement');
	}

	public function mount()
	{
		$userExperiencesList = ModelsExperience::where('user_id', auth()->id())->get();
		if (count($userExperiencesList) > 0) {
			foreach ($userExperiencesList as $exp) {
				$this->workExperiences[] = ['id' => $exp->id, 'designation' => $exp->designation, 'durationFrom' => $exp->from, 'durationTo' => $exp->to, 'company' => $exp->company, 'total' => $exp->total_emoluments, 'leaveReason' => $exp->leave_reason, 'is_working' => $exp->is_working];
			}
		} else {
			$this->workExperiences = [
				['id' => null, 'designation' => null, 'durationFrom' => null, 'durationTo' => null, 'company' => null, 'total' => null, 'leaveReason' => null, 'is_working' => false]
			];
		}
	}

	public function render()
	{
		return view('livewire.web.auth.experience');
	}
}
