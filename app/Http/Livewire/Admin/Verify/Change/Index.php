<?php

namespace App\Http\Livewire\Admin\Verify\Change;

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
		return view('livewire.admin.verify.change.index', [
			'infoCount' => ChangeBasicInfo::where('status', 'Pending')->count(),
			'addressCount' => ChangeAddress::where('status', 'Pending')->count(),
			'eduCount' => ChangeEducation::where('status', 'Pending')->count(),
			'expCount' => ChangeExperience::where('status', 'Pending')->count(),
			'transferCount' => Transfer::where('status', 'Pending')->count(),
		]);
	}
}
