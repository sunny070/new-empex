<?php

namespace App\Http\Livewire\Web\Auth;

use App\Models\BasicInfo as ModelsBasicInfo;
use App\Models\Language;
use App\Models\PhysicalChallenge;
use App\Models\Religion;
use App\Models\User;
use App\Models\UserCanRead;
use App\Models\UserCanSpeak;
use App\Models\UserCanWrite;
use App\Models\UserPhysicalChallenge;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class BasicInfo extends Component
{
  use WithFileUploads;

  public $name, $phone_no;
  public $date_of_birth, $gender, $parents_name, $marital_status, $religion, $caste, $image, $society = 'Mizo';
  public $aadhaar_number = null;
  public $userImage = null;
  public $ex_servicemen = false;
  public $email;

  public $languageRead = [];
  public $languageWrite = [];
  public $languageSpoken = [];

  public $userReadLanguages = [];
  public $userWriteLanguages = [];
  public $userSpokenLanguages = [];

  public $religions = [];
  public $languages = [];
  public $userPhysicalDisabled = [];
  public $physicalChallenges = [];
  public $disabledList = [];

  public function saveAndNext()
  {
    // dd('save next');
    $basicInfo = ModelsBasicInfo::query()->latest('updated_at')->firstOrNew(['user_id' => auth()->id()]);
    $this->validate([
      'image' => 'required_if:userImage,null|max:2048',
    //   'email' => 'required|email',
      'email' => 'required|unique:basic_infos,email,'.$basicInfo->id,
      'name' => 'required',
      'phone_no' => 'required|digits:10',
      'date_of_birth' => 'required',
      'gender' => 'required',
      'parents_name' => 'required',
      'marital_status' => 'required',
      'religion' => 'required',
      'caste' => 'required',
      'languageRead' => 'required',
      'languageWrite' => 'required',
      'languageSpoken' => 'required',
    ]);

    $user = User::where('id', auth()->id())->first();
    $user->name = $this->name;
    $user->mobile_no = $this->phone_no;
    $user->save();

    $basicInfo->full_name = $this->name;
    $basicInfo->dob = $this->date_of_birth;
    $basicInfo->email = $this->email;
    $basicInfo->gender = $this->gender;
    $basicInfo->phone_no = $this->phone_no;
    $basicInfo->parents_name = $this->parents_name;
    $basicInfo->religion_id = $this->religion;
    $basicInfo->caste = $this->caste;
    $basicInfo->marital_status = $this->marital_status;
    $basicInfo->aadhar_no = $this->aadhaar_number;
    $basicInfo->user_id = auth()->id();
    $basicInfo->society = $this->society;
    $basicInfo->percent_complete = '20';
    $basicInfo->ex_servicemen = $this->ex_servicemen == true ? 1 : 0;
    if ($this->image) {
      Storage::disk('public')->delete($basicInfo->avatar);
      $imageURL = $this->image->storePublicly('basic_info', 'public');
      $basicInfo->avatar = $imageURL;
    }
    if (count($this->userPhysicalDisabled) > 0) {
      $basicInfo->physically_challenge = 1;
    }
    $basicInfo->save();

    // user read language
    UserCanRead::where('user_id', auth()->id())->delete();
    foreach ($this->languageRead as $read) {
      $userRead = UserCanRead::firstOrNew(['user_id' => auth()->id(), 'language_id' => $read]);
      $userRead->save();
    }

    // user write language
    UserCanWrite::where('user_id', auth()->id())->delete();
    foreach ($this->languageWrite as $write) {
      $userWrite = UserCanWrite::firstOrNew(['user_id' => auth()->id(), 'language_id' => $write]);
      $userWrite->save();
    }

    // user spoken language
    UserCanSpeak::where('user_id', auth()->id())->delete();
    foreach ($this->languageSpoken as $spoken) {
      $userSpeak = UserCanSpeak::firstOrNew(['user_id' => auth()->id(), 'language_id' => $spoken]);
      $userSpeak->save();
    }

    // physical health category
    UserPhysicalChallenge::where('user_id', auth()->id())->delete();
    foreach ($this->userPhysicalDisabled as $disable) {
      $userDisable = UserPhysicalChallenge::firstOrNew(['user_id' => auth()->id(), 'physical_challenge_id' => $disable]);
      $userDisable->save();
    }

    $this->emit('stepIncrement');
  }

  public function mount()
  {
    $this->name = auth()->user()->name;
    $this->phone_no = auth()->user()->mobile_no;

    $basic_info = ModelsBasicInfo::where('user_id', auth()->id())->latest('updated_at')->first();
    if ($basic_info) {
      $this->name = $basic_info->full_name;
      $this->phone_no = $basic_info->phone_no;
      $this->date_of_birth = $basic_info->dob;
      $this->email = $basic_info->email;
      $this->gender = $basic_info->gender;
      $this->parents_name = $basic_info->parents_name;
      $this->marital_status = $basic_info->marital_status;
      $this->religion = $basic_info->religion_id;
      $this->aadhaar_number = $basic_info->aadhar_no;
      $this->userImage = $basic_info->avatar;
      $this->caste = $basic_info->caste;
      $this->society = $basic_info->society;
      $this->ex_servicemen = $basic_info->ex_servicemen;
    }


    // languages
    $userLanguageReads = UserCanRead::where('user_id', auth()->id())->get();
    if (count($userLanguageReads) > 0) {
      $this->userReadLanguages = $userLanguageReads;
      $this->languageRead = $userLanguageReads->map(function ($r) {
        return $r->language_id;
      });
    }

    $userLanguageWrites = UserCanWrite::where('user_id', auth()->id())->get();
    if (count($userLanguageWrites) > 0) {
      $this->userWriteLanguages = $userLanguageWrites;
      $this->languageWrite = $userLanguageWrites->map(function ($w) {
        return $w->language_id;
      });
    }

    $userLanguageSpokens = UserCanSpeak::where('user_id', auth()->id())->get();
    if (count($userLanguageSpokens) > 0) {
      $this->userSpokenLanguages = $userLanguageSpokens;
      $this->languageSpoken = $userLanguageSpokens->map(function ($s) {
        return $s->language_id;
      });
    }

    // physical challenge
    $userDisabledList = UserPhysicalChallenge::with('physicalChallenge')->where('user_id', auth()->id())->get();
    if (count($userDisabledList) > 0) {
      $this->disabledList = $userDisabledList;
      $this->userPhysicalDisabled = $userDisabledList->map(function ($p) {
        return $p->physical_challenge_id;
      });
    }

    $this->languages = Language::get();
    $this->physicalChallenges = PhysicalChallenge::get();
    $this->religions = Religion::get();
  }

  public function hydrate()
  {
    $this->emit('select2AutoInit');
    $this->resetErrorBag();
  }

  public function render()
  {
    return view('livewire.web.auth.basic-info');
  }
}
