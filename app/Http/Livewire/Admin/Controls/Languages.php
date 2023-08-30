<?php

namespace App\Http\Livewire\Admin\Controls;

use App\Models\ChangeUserCanRead;
use App\Models\ChangeUserCanSpeak;
use App\Models\ChangeUserCanWrite;
use App\Models\Language;
use App\Models\UserCanRead;
use App\Models\UserCanSpeak;
use App\Models\UserCanWrite;
use Livewire\Component;
use Livewire\WithPagination;

class Languages extends Component
{
  use WithPagination;

  public $addLanguageModal = false;
  public $editLanguageModal = false;
  public $deleteLanguageModal = false;
  public $languageName;
  public $languageId;
  public $name;

  protected $listeners = ['launchAddModal', 'launchUpdateModal'];

  public function launchAddModal()
  {
    $this->languageName = null;
    $this->addLanguageModal = true;
  }

  public function launchUpdateModal($id, $name)
  {
    $this->editLanguageModal = true;
    $this->languageName = $name;
    $this->languageId = $id;
  }

  public function addLanguage()
  {
    $this->validate([
      'languageName' => 'required',
    ]);

    $language = new Language();
    $language->name = $this->languageName;
    $language->save();
    $this->addLanguageModal = false;
  }

  public function updateLanguage()
  {
    $this->validate([
      'languageName' => 'required',
    ]);

    $language = Language::findOrFail($this->languageId);
    $language->name = $this->languageName;
    $language->save();
    $this->editLanguageModal = false;
  }

  public function openDeleteDialog($id)
  {
    $this->languageId = $id;
    $this->deleteLanguageModal = true;
  }

  public function closeDeleteDialog()
  {
    $this->languageId = null;
    $this->deleteLanguageModal = false;
  }

  public function deleteLanguage()
  {
    $speak = UserCanSpeak::where('language_id', $this->languageId)->first();
    $read = UserCanRead::where('language_id', $this->languageId)->first();
    $write = UserCanWrite::where('language_id', $this->languageId)->first();
    $changeSpeak = ChangeUserCanSpeak::where('language_id', $this->languageId)->first();
    $changeWrite = ChangeUserCanWrite::where('language_id', $this->languageId)->first();
    $changeRead = ChangeUserCanRead::where('language_id', $this->languageId)->first();

    if (!$speak && !$read && !$write && !$changeSpeak && !$changeWrite && !$changeRead) {
      Language::where('id', $this->languageId)->delete();
    } else {
      session()->flash('error', 'Permission denied! Language is used in another data.');
    }

    $this->deleteLanguageModal = false;
  }

  public function hydrate()
  {
    $this->resetValidation();
  }

  public function render()
  {
    return view('livewire.admin.controls.languages', [
      'languages' => Language::when($this->name, fn ($q) => $q->where('name', 'like', '%' . $this->name . '%'))
        ->paginate('10')
    ]);
  }
}
