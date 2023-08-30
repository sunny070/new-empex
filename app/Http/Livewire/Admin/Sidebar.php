<?php

namespace App\Http\Livewire\Admin;

use App\Models\Admin;
use App\Models\BasicInfo;
use App\Models\OnGoingApplication;
use App\Models\Renew;
use Livewire\Component;

class Sidebar extends Component
{
  public $verifyNew, $verifyChange;
  public $approveNew, $approveChange, $approveRenew,$newId;
  public $employerNoti;

  public function mount()
  {
    $this->verifyNew = BasicInfo::where('canEdit', 0)->where('status', 'Pending')->count();
    $this->verifyChange = OnGoingApplication::where('type', 'LIKE', 'Change request%')->where('status', 'Pending')->count();
    $this->approveNew = BasicInfo::where('canEdit', 0)->where('status', 'Verified')->whereNull('new_id')->count();
    $this->newId = BasicInfo::where('canEdit', 0)->where('status', 'Verified')->where('new_id','yes')->count();
    $this->approveChange = OnGoingApplication::where('type', 'LIKE', 'Change request%')->where('status', 'Verified')->count();
    $this->approveRenew = Renew::where('status', 'Pending')->count();
    $this->employerNoti = Admin::where('role_id', 4)->where('is_approved', 0)->count();
  }

  public function render()
  {
    return view('livewire.admin.sidebar');
  }
}
