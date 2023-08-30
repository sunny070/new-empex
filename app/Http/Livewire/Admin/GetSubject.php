<?php

namespace App\Http\Livewire\Admin;

use App\Models\Qualification;
use App\Models\Subject;
use Livewire\Component;

class GetSubject extends Component
{
  public $qualificationId, $qualification, $subjects;

  public function mount()
  {
    $this->qualification = Qualification::get();
  }

  public function changeQualification()
  {
    $this->subjects = Subject::where('qualification_id', $this->qualificationId)->get();
  }
  public function render()
  {
    return view('livewire.admin.get-subject');
  }
}
