<?php

namespace App\Http\Livewire\Web\Auth\Change;

use App\Jobs\SendStatusSms;
use App\Models\BasicInfo;
use App\Models\ChangeExperience;
use App\Models\Experience as ModelsExperience;
use App\Models\OnGoingApplication;
use Livewire\Component;

class Experience extends Component
{
    public $hasExperience = true;
    public $expText = 'Yes';

    public $workExperiences = [];
    public $userExperiences = [];

    public $canChange = true;

    public function addMoreExperience()
    {
        $this->workExperiences[] = ['id' => null, 'designation' => null, 'durationFrom' => null, 'durationTo' => null, 'company' => null, 'total' => null, 'leaveReason' => null, 'is_working' => false];
    }

    public function removeExperience()
    {
        unset($this->workExperiences[array_key_last($this->workExperiences)]);
        $this->workExperiences = array_values($this->workExperiences);
    }

    public function currentlyWorking($index)
    {
        $this->workExperiences[$index]['durationTo'] = null;
        $this->workExperiences[$index]['is_working'] = !$this->workExperiences[$index]['is_working'];
        $this->workExperiences = array_values($this->workExperiences);
    }

    public function submit()
    {
        $this->validate([
            'workExperiences.*.designation' => 'required',
            'workExperiences.*.company' => 'required',
            'workExperiences.*.durationFrom' => 'required',
            'workExperiences.*.durationTo' => 'required_if:workExperiences.*.is_working,false',
            'workExperiences.*.total' => 'required',
        ]);

        ChangeExperience::where('user_id', auth()->id())->delete();
        foreach ($this->workExperiences as $experience) {
            $userExp = new ChangeExperience;
            $userExp->user_id = auth()->id();
            $userExp->designation = $experience['designation'];
            $userExp->from = $experience['durationFrom'];
            $userExp->to = $experience['durationTo'];
            $userExp->company = $experience['company'];
            $userExp->total_emoluments = $experience['total'];
            $userExp->leave_reason = $experience['leaveReason'];
            $userExp->is_working = $experience['is_working'] == true ? 1 : 0;
            $userExp->user_district_id = BasicInfo::where('user_id', auth()->id())->latest('updated_at')->value('district_id');
            $userExp->save();
        }

        $ongoing = new OnGoingApplication();
        $ongoing->user_id = auth()->id();
        $ongoing->type = 'Change request - Experiences';
        $ongoing->model_name = 'Experience';
        $ongoing->requested_id = $userExp->id;
        $ongoing->status = 'Pending';
        $ongoing->color = '#ff7e0e';
        $ongoing->bg = '#fff5ef';
        $ongoing->save();

        SendStatusSms::dispatch(auth()->user()->mobile_no, 'change experience', 'received')->delay(30);

        session()->flash('message', 'Change Requested submitted successfully!');
        return redirect(route('auth.employee.changerequest'));
    }

    public function back()
    {
        $this->emit('stepDecrement');
    }

    public function mount()
    {
        $alreadySubmitted = ChangeExperience::where('user_id', auth()->id())->latest('updated_at')->first();

        if ($alreadySubmitted) {
            $this->canChange = false;
        } else {
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
    }

    public function render()
    {
        return view('livewire.web.auth.change.experience');
    }
}
