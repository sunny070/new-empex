<?php

namespace App\Http\Livewire\Admin\Controls\Education;

use App\Models\ChangeEducation;
use App\Models\EducationQualification;
use App\Models\Qualification as ModelsQualification;
use App\Models\Subject;
use Livewire\Component;
use Livewire\WithPagination;

class Qualification extends Component
{
  use WithPagination;

  public $qualificationName;
  public $qualificationId;
  public $addDialog = false;
  public $updateDialog = false;
  public $deleteDialog = false;
  public $name;

  public function openAddDialog()
  {
    $this->qualificationName = null;
    $this->addDialog = true;
  }
  public function openUpdateDialog($id, $name)
  {
    $this->updateDialog = true;
    $this->qualificationId = $id;
    $this->qualificationName = $name;
  }

  public function openDeleteDialog($id)
  {
    $this->qualificationId = $id;
    $this->deleteDialog = true;
  }

  public function closeDeleteDialog()
  {
    $this->qualificationId = null;
    $this->deleteDialog = false;
  }

  public function addQualification()
  {
    $this->validate([
      'qualificationName' => 'required',
    ]);

    $state = new ModelsQualification;
    $state->name = $this->qualificationName;
    $state->save();
    $this->addDialog = false;
  }

  public function updateQualification()
  {
    $this->validate([
      'qualificationName' => 'required',
    ]);

    $state = ModelsQualification::findOrFail($this->qualificationId);
    $state->name = $this->qualificationName;
    $state->save();
    $this->updateDialog = false;
  }

  public function deleteQualification()
  {
    $edu = EducationQualification::where('qualification_id', $this->qualificationId)->first();
    $change = ChangeEducation::where('qualification_id', $this->qualificationId)->first();
    $subj = Subject::where('qualification_id', $this->qualificationId)->first();

    if (!$edu && !$change && !$subj) {
      ModelsQualification::findOrFail($this->qualificationId)->delete();
    } else {
      session()->flash('error', 'Permission denied! Qualification is used in another data.');
    }

    $this->deleteDialog = false;
  }

  public function hydrate()
  {
    $this->resetValidation();
  }

  public function render()
  {
    return view('livewire.admin.controls.education.qualification', [
      'qualifications' => ModelsQualification::when($this->name, fn ($q) => $q->where('name', 'like', '%' . $this->name . '%'))
        ->paginate(10),
    ]);
  }
}
