<?php

namespace App\Http\Livewire\Web\Auth\Change;

use App\Jobs\SendStatusSms;
use App\Models\BasicInfo as ModelsBasicInfo;
use App\Models\ChangeBasicInfo;
use App\Models\ChangeUserCanRead;
use App\Models\ChangeUserCanSpeak;
use App\Models\ChangeUserCanWrite;
use App\Models\ChangeUserPhysicalChallenge;
use App\Models\Language;
use App\Models\OnGoingApplication;
use App\Models\PhysicalChallenge;
use App\Models\Religion;
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

	public $canChange = true;

	public function submit()
	{
		$this->validate([
			'image' => 'required_if:userImage,null|max:2048',
			'name' => 'required',
			'email' => 'required|email',
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

		$changeInfo = ChangeBasicInfo::firstOrNew(['user_id' => auth()->id()]);
		$changeInfo->full_name = $this->name;
		$changeInfo->dob = $this->date_of_birth;
		$changeInfo->gender = $this->gender;
		$changeInfo->email = $this->email;
		$changeInfo->phone_no = $this->phone_no;
		$changeInfo->parents_name = $this->parents_name;
		$changeInfo->religion_id = $this->religion;
		$changeInfo->caste = $this->caste;
		$changeInfo->marital_status = $this->marital_status;
		$changeInfo->aadhar_no = $this->aadhaar_number;
		$changeInfo->user_id = auth()->id();
		$changeInfo->society = $this->society;
		$changeInfo->user_district_id = ModelsBasicInfo::where('user_id', auth()->id())->latest('updated_at')->value('district_id');

		if ($this->image) {
			Storage::disk('public')->delete($changeInfo->avatar);
			$imageURL = $this->image->storePublicly('basic_info', 'public');
			$changeInfo->avatar = $imageURL;
		} else {
			$changeInfo->avatar = $this->userImage;
		}
		$changeInfo->save();

		// user read language
		ChangeUserCanRead::where('user_id', auth()->id())->delete();
		foreach ($this->languageRead as $read) {
			$userRead = ChangeUserCanRead::firstOrNew(['user_id' => auth()->id(), 'language_id' => $read]);
			$userRead->save();
		}

		// user write language
		ChangeUserCanWrite::where('user_id', auth()->id())->delete();
		foreach ($this->languageWrite as $write) {
			$userWrite = ChangeUserCanWrite::firstOrNew(['user_id' => auth()->id(), 'language_id' => $write]);
			$userWrite->save();
		}

		// user spoken language
		ChangeUserCanSpeak::where('user_id', auth()->id())->delete();
		foreach ($this->languageSpoken as $spoken) {
			$userSpeak = ChangeUserCanSpeak::firstOrNew(['user_id' => auth()->id(), 'language_id' => $spoken]);
			$userSpeak->save();
		}

		// physical health category
		ChangeUserPhysicalChallenge::where('user_id', auth()->id())->delete();
		foreach ($this->userPhysicalDisabled as $disable) {
			$userDisable = ChangeUserPhysicalChallenge::firstOrNew(['user_id' => auth()->id(), 'physical_challenge_id' => $disable]);
			$userDisable->save();
		}

		$ongoing = new OnGoingApplication();
		$ongoing->user_id = auth()->id();
		$ongoing->type = 'Change request - Basic info';
		$ongoing->model_name = 'BasicInfo';
		$ongoing->requested_id = $changeInfo->id;
		$ongoing->status = 'Pending';
		$ongoing->color = '#ff7e0e';
		$ongoing->bg = '#fff5ef';
		$ongoing->save();

		SendStatusSms::dispatch(auth()->user()->mobile_no, 'change information', 'received')->delay(30);

		session()->flash('message', 'Change Requested submitted successfully!');
		return redirect(route('auth.employee.changerequest'));
	}

	public function mount()
	{
		$alreadySubmitted = ChangeBasicInfo::where('user_id', auth()->id())->latest('updated_at')->first();

		if ($alreadySubmitted) {
			$this->canChange = false;
		} else {
			$basic_info = ModelsBasicInfo::where('user_id', auth()->id())->where('status','Approved')->latest('updated_at')->first();
			if ($basic_info) {
				$this->name = $basic_info->full_name;
				$this->phone_no = $basic_info->phone_no;
				$this->date_of_birth = $basic_info->dob;
				$this->gender = $basic_info->gender;
				$this->email = $basic_info->email;
				$this->parents_name = $basic_info->parents_name;
				$this->marital_status = $basic_info->marital_status;
				$this->religion = $basic_info->religion_id;
				$this->aadhaar_number = $basic_info->aadhar_no;
				$this->userImage = $basic_info->avatar;
				$this->caste = $basic_info->caste;
				$this->society = $basic_info->society;
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
	}

	public function hydrate()
	{
		$this->emit('select2AutoInit');
	}

	public function render()
	{
		return view('livewire.web.auth.change.basic-info');
	}
}
