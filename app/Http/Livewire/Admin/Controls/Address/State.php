<?php

namespace App\Http\Livewire\Admin\Controls\Address;

use App\Models\Address;
use App\Models\ChangeAddress;
use App\Models\District;
use App\Models\OrganizationAddress;
use App\Models\State as ModelsState;
use App\Models\Transfer;
use Livewire\Component;

class State extends Component
{
  public $stateName;
  public $stateId;
  public $addDialog = false;
  public $updateDialog = false;
  public $deleteDialog = false;
  public $name;

  public function openAddDialog()
  {
    $this->stateName = null;
    $this->addDialog = true;
  }
  public function openUpdateDialog($id, $name)
  {
    $this->updateDialog = true;
    $this->stateId = $id;
    $this->stateName = $name;
  }

  public function openDeleteDialog($id)
  {
    $this->stateId = $id;
    $this->deleteDialog = true;
  }

  public function closeDeleteDialog()
  {
    $this->stateId = null;
    $this->deleteDialog = false;
  }

  public function addState()
  {
    $this->validate([
      'stateName' => 'required',
    ]);

    $state = new ModelsState;
    $state->name = $this->stateName;
    $state->save();
    $this->addDialog = false;
  }

  public function updateState()
  {
    $this->validate([
      'stateName' => 'required',
    ]);

    $state = ModelsState::findOrFail($this->stateId);
    $state->name = $this->stateName;
    $state->save();
    $this->updateDialog = false;
  }

  public function deleteState()
  {
    $address = Address::where('state_id', $this->stateId)->first();
    $district = District::where('state_id', $this->stateId)->first();
    $change = ChangeAddress::where('state_id', $this->stateId)->first();
    $transfer = Transfer::where('state_id', $this->stateId)->first();
    $org = OrganizationAddress::where('state_id', $this->stateId)->first();

    if (!$address && !$district && !$change && !$transfer && !$org) {
      ModelsState::findOrFail($this->stateId)->delete();
    } else {
      session()->flash('error', 'Permission denied! State is used in another data.');
    }

    $this->deleteDialog = false;
  }

  public function hydrate()
  {
    $this->resetValidation();
  }

  public function render()
  {
    return view('livewire.admin.controls.address.state', [
      'states' => ModelsState::when($this->name, fn ($q) => $q->where('name', 'like', '%' . $this->name . '%'))
        ->paginate(10),
    ]);
  }
}
