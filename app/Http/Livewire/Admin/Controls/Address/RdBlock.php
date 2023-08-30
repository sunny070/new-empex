<?php

namespace App\Http\Livewire\Admin\Controls\Address;

use App\Models\RdBlock as ModelsRdBlock;
use App\Models\Village;
use Livewire\Component;
use Livewire\WithPagination;

class RdBlock extends Component
{
  use WithPagination;

  public $rdBlockName;
  public $rdBlockId;
  public $addDialog = false;
  public $updateDialog = false;
  public $deleteDialog = false;
  public $name;

  public function openAddDialog()
  {
    $this->rdBlockName = null;
    $this->addDialog = true;
  }
  public function openUpdateDialog($id, $name)
  {
    $this->updateDialog = true;
    $this->rdBlockId = $id;
    $this->rdBlockName = $name;
  }

  public function openDeleteDialog($id)
  {
    $this->rdBlockId = $id;
    $this->deleteDialog = true;
  }

  public function closeDeleteDialog()
  {
    $this->rdBlockId = null;
    $this->deleteDialog = false;
  }

  public function addRdBlock()
  {
    $this->validate([
      'rdBlockName' => 'required',
    ]);

    $state = new ModelsRdBlock;
    $state->name = $this->rdBlockName;
    $state->save();
    $this->addDialog = false;
  }

  public function updateRdBlock()
  {
    $this->validate([
      'rdBlockName' => 'required',
    ]);

    $state = ModelsRdBlock::findOrFail($this->rdBlockId);
    $state->name = $this->rdBlockName;
    $state->save();
    $this->updateDialog = false;
  }

  public function deleteRdBlock()
  {
    $village = Village::where('rd_block_id', $this->rdBlockId)->first();

    if (!$village) {
      ModelsRdBlock::findOrFail($this->rdBlockId)->delete();
    } else {
      session()->flash('error', 'Permission denied! Rd block is used in another data.');
    }

    $this->deleteDialog = false;
  }

  public function hydrate()
  {
    $this->resetValidation();
  }

  public function render()
  {
    return view('livewire.admin.controls.address.rd-block', [
      'rdBlocks' => ModelsRdBlock::when($this->name, fn ($q) => $q->where('name', 'like', '%' . $this->name . '%'))
        ->paginate(10)
    ]);
  }
}
