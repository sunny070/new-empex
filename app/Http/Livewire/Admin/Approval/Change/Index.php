<?php

namespace App\Http\Livewire\Admin\Approval\Change;

use App\Models\ChangeAddress;
use App\Models\ChangeBasicInfo;
use App\Models\ChangeEducation;
use App\Models\ChangeExperience;
use App\Models\Transfer;
use Livewire\Component;

class Index extends Component
{
	public function render()
	{
		return view('livewire.admin.approval.change.index', [
			'infoCount' => ChangeBasicInfo::where('status', 'Verified')->count(),
			'addressCount' => ChangeAddress::where('status', 'Verified')->count(),
			'eduCount' => ChangeEducation::where('status', 'Verified')->count(),
			'expCount' => ChangeExperience::where('status', 'Verified')->count(),
			'transferCount' => Transfer::where('status', 'Verified')->count(),
		]);
	}
}
