<?php

namespace App\Http\Livewire\Admin\Controls\Address;

use App\Models\PoliceStation as ModelsPoliceStation;
use App\Models\Village;
use Livewire\Component;
use Livewire\WithPagination;

class PoliceStation extends Component
{
  use WithPagination;

  public $states;
  public $policeStationName;
  public $policeStationId;
  public $addDialog = false;
  public $updateDialog = false;
  public $deleteDialog = false;
  public $name;

  public function openAddDialog()
  {
    $this->policeStationName = null;
    $this->addDialog = true;
  }
  public function openUpdateDialog($id, $name)
  {
    $this->updateDialog = true;
    $this->policeStationId = $id;
    $this->policeStationName = $name;
  }

  public function openDeleteDialog($id)
  {
    $this->policeStationId = $id;
    $this->deleteDialog = true;
  }

  public function closeDeleteDialog()
  {
    $this->policeStationId = null;
    $this->deleteDialog = false;
  }

  public function addPoliceStation()
  {
    $this->validate([
      'policeStationName' => 'required',
    ]);

    $state = new ModelsPoliceStation;
    $state->name = $this->policeStationName;
    $state->save();
    $this->addDialog = false;
  }

  public function updatePoliceStation()
  {
    $this->validate([
      'policeStationName' => 'required',
    ]);

    $state = ModelsPoliceStation::findOrFail($this->policeStationId);
    $state->name = $this->policeStationName;
    $state->save();
    $this->updateDialog = false;
  }

  public function deletePoliceStation()
  {
    $village = Village::where('police_station_id', $this->policeStationId)->first();

    if (!$village) {
      ModelsPoliceStation::findOrFail($this->policeStationId)->delete();
    } else {
      session()->flash('error', 'Permission denied! Police station is used in another data.');
    }

    $this->deleteDialog = false;
  }

  public function hydrate()
  {
    $this->resetValidation();
  }

  public function render()
  {
    return view('livewire.admin.controls.address.police-station', [
      'policeStations' => ModelsPoliceStation::when($this->name, fn ($q) => $q->where('name', 'like', '%' . $this->name . '%'))
        ->paginate(10),
    ]);
  }
}
