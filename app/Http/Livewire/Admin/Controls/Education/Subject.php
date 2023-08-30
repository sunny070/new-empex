<?php

namespace App\Http\Livewire\Admin\Controls\Education;

use App\Models\ChangeEducation;
use App\Models\EducationQualification;
use App\Models\MajorCore;
use App\Models\Qualification;
use App\Models\Subject as ModelsSubject;
use Livewire\Component;
use Livewire\WithPagination;

class Subject extends Component
{
  use WithPagination;

  public $subjectName;
  public $subjectId;
  public $qualification;
  public $addDialog = false;
  public $updateDialog = false;
  public $deleteDialog = false;
  public $name;
  public $qualifi;

  public function openAddDialog()
  {
    $this->subjectName = null;
    $this->addDialog = true;
  }
  public function openUpdateDialog($id, $name, $qualification)
  {
    $this->updateDialog = true;
    $this->subjectId = $id;
    $this->subjectName = $name;
    $this->qualification = $qualification;
  }

  public function openDeleteDialog($id)
  {
    $this->subjectId = $id;
    $this->deleteDialog = true;
  }

  public function closeDeleteDialog()
  {
    $this->subjectId = null;
    $this->deleteDialog = false;
  }

  public function addSubject()
  {
    $this->validate([
      'qualification' => 'required',
      'subjectName' => 'required',
    ]);

    $subject = new ModelsSubject;
    $subject->qualification_id = $this->qualification;
    $subject->name = $this->subjectName;
    $subject->save();
    $this->addDialog = false;
  }

  public function updateSubject()
  {
    $this->validate([
      'qualification' => 'required',
      'subjectName' => 'required',
    ]);

    $subject = ModelsSubject::findOrFail($this->subjectId);
    $subject->qualification_id = $this->qualification;
    $subject->name = $this->subjectName;
    $subject->save();
    $this->updateDialog = false;
  }

  public function deleteSubject()
  {
    $edu = EducationQualification::where('subject_id', $this->subjectId)->first();
    $change = ChangeEducation::where('subject_id', $this->subjectId)->first();
    $core = MajorCore::where('subject_id', $this->subjectId)->first();

    if (!$edu && !$change && !$core) {
      ModelsSubject::findOrFail($this->subjectId)->delete();
    } else {
      session()->flash('error', 'Permission denied! Subject is used in another data.');
    }

    $this->deleteDialog = false;
  }

  public function hydrate()
  {
    $this->resetValidation();
  }

  public function render()
  {
    return view('livewire.admin.controls.education.subject', [
      'subjects' => ModelsSubject::when($this->name, fn ($q) => $q->where('name', 'like', '%' . $this->name . '%'))
        ->when($this->qualifi, fn ($q) => $q->where('qualification_id', $this->qualifi))
        ->paginate(10),
      'qualifications' => Qualification::get(),
    ]);
  }
}
