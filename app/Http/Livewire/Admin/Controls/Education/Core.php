<?php

namespace App\Http\Livewire\Admin\Controls\Education;

use App\Models\ChangeEducation;
use App\Models\EducationQualification;
use App\Models\MajorCore;
use App\Models\Qualification;
use App\Models\Subject;
use Livewire\Component;
use Livewire\WithPagination;

class Core extends Component
{
  use WithPagination;

  public $coreName;
  public $coreId;
  public $subject;
  public $addDialog = false;
  public $updateDialog = false;
  public $deleteDialog = false;
  public $name;
  public $subj;

  public function openAddDialog()
  {
    $this->subject = null;
    $this->coreName = null;
    $this->addDialog = true;
  }
  public function openUpdateDialog($id, $name, $subject)
  {
    $this->updateDialog = true;
    $this->coreId = $id;
    $this->coreName = $name;
    $this->subject = $subject;
  }

  public function openDeleteDialog($id)
  {
    $this->coreId = $id;
    $this->deleteDialog = true;
  }

  public function closeDeleteDialog()
  {
    $this->coreId = null;
    $this->deleteDialog = false;
  }

  public function addCore()
  {
    $this->validate([
      'subject' => 'required',
      'coreName' => 'required',
    ]);

    $majorCore = new MajorCore;
    $majorCore->subject_id = $this->subject;
    $majorCore->name = $this->coreName;
    $majorCore->save();
    $this->addDialog = false;
  }

  public function updateCore()
  {
    $this->validate([
      'subject' => 'required',
      'coreName' => 'required',
    ]);

    $majorCore = MajorCore::findOrFail($this->coreId);
    $majorCore->subject_id = $this->subject;
    $majorCore->name = $this->coreName;
    $majorCore->save();
    $this->updateDialog = false;
  }

  public function deleteCore()
  {
    $edu = EducationQualification::where('major_core_id', $this->coreId)->first();
    $change = ChangeEducation::where('major_core_id', $this->coreId)->first();

    if (!$edu && !$change) {
      MajorCore::findOrFail($this->coreId)->delete();
    } else {
      session()->flash('error', 'Permission denied! Major core is used in another data.');
    }

    $this->deleteDialog = false;
  }

  public function hydrate()
  {
    $this->resetValidation();
  }

  public function render()
  {
    return view('livewire.admin.controls.education.core', [
      'cores' => MajorCore::when($this->name, fn ($q) => $q->where('name', 'like', '%' . $this->name . '%'))
        ->when($this->subj, fn ($q) => $q->where('subject_id', $this->subj))
        ->paginate(10),
      'subjects' => Subject::with('qualification')->orderBy('name', 'ASC')->get(),
    ]);
  }
}
