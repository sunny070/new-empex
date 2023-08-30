<?php

namespace App\Http\Livewire\Admin\Controls;

use App\Models\Department;
use App\Models\JobPost;
use App\Models\Organization;
use Livewire\Component;
use Livewire\WithPagination;

class Departments extends Component
{
  use WithPagination;

  public $departmentName;
  public $departmentId;
  public $name;
  public $addDepartmentModal = false;
  public $editDepartmentModal = false;
  public $deleteDepartmentModal = false;

  protected $listeners = ['launchAddModal', 'launchUpdateModal'];

  public function launchAddModal()
  {
    $this->departmentName = null;
    $this->addDepartmentModal = true;
  }

  public function launchUpdateModal($id, $name)
  {
    $this->editDepartmentModal = true;
    $this->departmentName = $name;
    $this->departmentId = $id;
  }

  public function addDepartment()
  {
    $this->validate([
      'departmentName' => 'required',
    ]);

    $department = new Department;
    $department->name = $this->departmentName;
    $department->save();
    $this->addDepartmentModal = false;
    // return back();
  }

  public function updateDepartment()
  {
    $this->validate([
      'departmentName' => 'required',
    ]);

    $department = Department::findOrFail($this->departmentId);
    $department->name = $this->departmentName;
    $department->save();
    $this->editDepartmentModal = false;
  }

  public function openDeleteDialog($id)
  {
    $this->departmentId = $id;
    $this->deleteDepartmentModal = true;
  }

  public function closeDeleteDialog()
  {
    $this->departmentId = null;
    $this->deleteDepartmentModal = false;
  }

  public function deleteDepartment()
  {
    $org = Organization::where('department_id', $this->departmentId)->first();
    $job = JobPost::where('department_id', $this->departmentId)->first();

    if (!$org && !$job) {
      Department::where('id', $this->departmentId)->delete();
    } else {
      session()->flash('error', 'Permission denied! Department is used in another data.');
    }

    $this->deleteDepartmentModal = false;
  }

  public function hydrate()
  {
    $this->resetValidation();
  }

  public function render()
  {
    return view('livewire.admin.controls.departments', [
      'departments' => Department::when($this->name, fn ($q) => $q->where('name', 'like', '%' . $this->name . '%'))
        ->paginate(10),
    ]);
  }
}
