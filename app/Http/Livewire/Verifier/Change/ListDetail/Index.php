<?php

namespace App\Http\Livewire\Verifier\Change\ListDetail;

use App\Models\AdminDistrict;
use App\Models\ChangeAddress;
use App\Models\ChangeBasicInfo;
use App\Models\ChangeEducation;
use App\Models\ChangeExperience;
use App\Models\Transfer;
use Livewire\Component;

class Index extends Component
{
	public $authDistricts;

	public function mount()
	{
		$this->authDistricts = AdminDistrict::where('admin_id', auth()->guard('admin')->id())->pluck('district_id')->toArray();
	}

	public function render()
	{
		return view('livewire.verifier.change.list-detail.index', [
			'infoCount' => ChangeBasicInfo::where('status', 'Pending')->whereIn('user_district_id', $this->authDistricts)->count(),
			'addressCount' => ChangeAddress::where('status', 'Pending')->whereIn('user_district_id', $this->authDistricts)->count(),
			'eduCount' => ChangeEducation::where('status', 'Pending')->whereIn('user_district_id', $this->authDistricts)->count(),
			'expCount' => ChangeExperience::where('status', 'Pending')->whereIn('user_district_id', $this->authDistricts)->count(),
			'transferCount' => Transfer::where('status', 'Pending')->whereIn('user_district_id', $this->authDistricts)->count(),
		]);
	}
}
