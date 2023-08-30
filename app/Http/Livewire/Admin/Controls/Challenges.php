<?php

namespace App\Http\Livewire\Admin\Controls;

use App\Models\ChangeUserPhysicalChallenge;
use App\Models\PhysicalChallenge;
use App\Models\UserPhysicalChallenge;
use Livewire\Component;
use Livewire\WithPagination;

class Challenges extends Component
{
  use WithPagination;

  public $challengeName;
  public $challengeId;
  public $name;
  public $addChallengeModal = false;
  public $editChallengeModal = false;
  public $deleteChallengeModal = false;

  protected $listeners = ['launchAddModal', 'launchUpdateModal'];

  public function launchAddModal()
  {
    $this->challengeName = null;
    $this->addChallengeModal = true;
  }

  public function launchUpdateModal($id, $name)
  {
    $this->editChallengeModal = true;
    $this->challengeName = $name;
    $this->challengeId = $id;
  }

  public function addChallenge()
  {
    $this->validate([
      'challengeName' => 'required',
    ]);

    $challenge = new PhysicalChallenge;
    $challenge->name = $this->challengeName;
    $challenge->save();
    $this->addChallengeModal = false;
  }

  public function updateChallenge()
  {
    $this->validate([
      'challengeName' => 'required',
    ]);

    $challenge = PhysicalChallenge::findOrFail($this->challengeId);
    $challenge->name = $this->challengeName;
    $challenge->save();
    $this->editChallengeModal = false;
  }

  public function openDeleteDialog($id)
  {
    $this->challengeId = $id;
    $this->deleteChallengeModal = true;
  }

  public function closeDeleteDialog()
  {
    $this->challengeId = null;
    $this->deleteChallengeModal = false;
  }

  public function deleteChallenge()
  {
    $usr = UserPhysicalChallenge::where('physical_challenge_id', $this->challengeId)->first();
    $chng = ChangeUserPhysicalChallenge::where('physical_challenge_id', $this->challengeId)->first();

    if (!$usr && !$chng) {
      PhysicalChallenge::where('id', $this->challengeId)->delete();
    } else {
      session()->flash('error', 'Permission denied! Physical challenge is used in another data.');
    }

    $this->deleteChallengeModal = false;
  }

  public function hydrate()
  {
    $this->resetValidation();
  }

  public function render()
  {
    return view('livewire.admin.controls.challenges', [
      'challenges' => PhysicalChallenge::when($this->name, fn ($q) => $q->where('name', 'like', '%' . $this->name . '%'))
        ->paginate(10),
    ]);
  }
}
