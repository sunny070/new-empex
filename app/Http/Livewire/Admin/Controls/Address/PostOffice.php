<?php

namespace App\Http\Livewire\Admin\Controls\Address;

use App\Models\PostOffice as ModelsPostOffice;
use App\Models\Village;
use Livewire\Component;
use Livewire\WithPagination;

class PostOffice extends Component
{
  use WithPagination;
  public $postOfficeName;
  public $postOfficeId;
  public $addDialog = false;
  public $updateDialog = false;
  public $deleteDialog = false;
  public $name;

  public function openAddDialog()
  {
    $this->postOfficeName = null;
    $this->addDialog = true;
  }
  public function openUpdateDialog($id, $name)
  {
    $this->updateDialog = true;
    $this->postOfficeId = $id;
    $this->postOfficeName = $name;
  }

  public function openDeleteDialog($id)
  {
    $this->postOfficeId = $id;
    $this->deleteDialog = true;
  }

  public function closeDeleteDialog()
  {
    $this->postOfficeId = null;
    $this->deleteDialog = false;
  }

  public function addPostOffice()
  {
    $this->validate([
      'postOfficeName' => 'required',
    ]);

    $state = new ModelsPostOffice;
    $state->name = $this->postOfficeName;
    $state->save();
    $this->addDialog = false;
  }

  public function updatePostOffice()
  {
    $this->validate([
      'postOfficeName' => 'required',
    ]);

    $state = ModelsPostOffice::findOrFail($this->postOfficeId);
    $state->name = $this->postOfficeName;
    $state->save();
    $this->updateDialog = false;
  }

  public function deletePostOffice()
  {
    $village = Village::where('post_office_id', $this->postOfficeId)->first();

    if (!$village) {
      ModelsPostOffice::findOrFail($this->postOfficeId)->delete();
    } else {
      session()->flash('error', 'Permission denied! Post office is used in another data.');
    }

    $this->deleteDialog = false;
  }

  public function hydrate()
  {
    $this->resetValidation();
  }

  public function render()
  {
    return view('livewire.admin.controls.address.post-office', [
      'postOffices' => ModelsPostOffice::when($this->name, fn ($q) => $q->where('name', 'like', '%' . $this->name . '%'))
        ->paginate(10),
    ]);
  }
}
