<?php

namespace App\Http\Livewire\Admin\ChangeRequest;

use App\Jobs\SendStatusSms;
use App\Models\Address;
use App\Models\BasicInfo;
use App\Models\OnGoingApplication;
use App\Models\Transfer as ModelsTransfer;
use Livewire\Component;

class Transfer extends Component
{
  public $transfer;
  public $origin;
  public $approveDialog = false;
  public $rejectDialog = false;
  public $requested_id;
  public $user;
  public $rejectionNote;

  public function goBack()
  {
    return redirect(route('admin.approve.change.request'));
  }

  public function openApproveDialog()
  {
    $this->approveDialog = true;
  }

  public function closeApproveDialog()
  {
    $this->approveDialog = false;
  }

  public function openRejectDialog()
  {
    $this->rejectDialog = true;
  }

  public function closeRejectDialog()
  {
    $this->rejectDialog = false;
  }

  public function rejectChange()
  {
    ModelsTransfer::findOrFail($this->requested_id)->delete();

    $ongoing = OnGoingApplication::where('type', 'Change request - Transfer')->where('status', '!=', 'Rejected')->where('model_name', 'Address')->where('requested_id', $this->requested_id)->where('user_id', $this->transfer->user->id)->first();
    $ongoing->rejected_date = today();
    $ongoing->status = 'Rejected';
    $ongoing->rejection_note = $this->rejectionNote;
    $ongoing->save();

    SendStatusSms::dispatch($this->transfer->user->mobile_no, 'transfer request', 'rejected')->delay(30);

    return redirect(route('admin.approve.change.request'));
  }

  public function approveChange()
  {
    OnGoingApplication::where('type', 'Change request - Transfer')->where('model_name', 'Address')->where('requested_id', $this->requested_id)->where('user_id', $this->transfer->user->id)->delete();

    SendStatusSms::dispatch($this->transfer->user->mobile_no, 'transfer request', 'approved')->delay(30);

    $address = Address::where('user_id', $this->transfer->user->id)->where('type', 'present')->latest('updated_at')->first();
    if ($address == null) {
      $newAddress = new Address();
    } else {
      $newAddress = $address;
    }

    $newAddress->user_id = $this->transfer->user_id;
    $newAddress->state_id = $this->transfer->state_id;
    $newAddress->district_id = $this->transfer->district_id;
    $newAddress->village = $this->transfer->village;
    $newAddress->pin_code = $this->transfer->pin_code;
    $newAddress->house_no = $this->transfer->house_no;
    $newAddress->police_station_id = $this->transfer->police_station_id;
    $newAddress->post_office_id = $this->transfer->post_office_id;
    $newAddress->rd_block_id = $this->transfer->rd_block_id;
    $newAddress->same_as_permanent = 0;
    $newAddress->type = 'present';
    $newAddress->save();

    $info = BasicInfo::where('user_id', $this->transfer->user->id)->latest('updated_at')->first();
    $info->district_id = $this->transfer->district_id;
    $info->save();

    ModelsTransfer::findOrFail($this->requested_id)->delete();

    return redirect(route('admin.approve.change.request'));
  }

  public function mount($id)
  {
    $this->requested_id = $id;
    $this->transfer = ModelsTransfer::with('user', 'state', 'district', 'rdBlock', 'policeStation', 'postOffice')->findOrFail($id);

    $this->origin = Address::where('user_id', $this->transfer->user->id)->where('type', 'present')->first();
    if ($this->origin == null) {
      $this->origin = Address::where('user_id', $this->transfer->user->id)->where('type', 'permanent')->first();
    }
  }

  public function render()
  {
    return view('livewire.admin.change-request.transfer');
  }
}
