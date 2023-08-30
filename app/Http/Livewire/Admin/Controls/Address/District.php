<?php

namespace App\Http\Livewire\Admin\Controls\Address;

use App\Models\Address;
use App\Models\AdminDistrict;
use App\Models\BasicInfo;
use App\Models\ChangeAddress;
use App\Models\District as ModelsDistrict;
use App\Models\OrganizationAddress;
use App\Models\State;
use App\Models\Transfer;
use App\Models\Village;
use Livewire\Component;
use Livewire\WithPagination;

class District extends Component
{
  use WithPagination;
  public $districtName;
  public $name;
  public $state;
  public $districtId;
  public $districtCode;
  public $addDialog = false;
  public $updateDialog = false;
  public $deleteDialog = false;
  public $st;

  public function openAddDialog()
  {
    $this->districtName = null;
    $this->addDialog = true;
    $this->districtCode = null;
    $this->state = null;
  }

  public function openUpdateDialog($id, $name, $code, $state)
  {
    $this->updateDialog = true;
    $this->districtId = $id;
    $this->districtName = $name;
    $this->state = $state;
    $this->districtCode = $code;
  }

  public function openDeleteDialog($id)
  {
    $this->districtId = $id;
    $this->deleteDialog = true;
  }

  public function closeDeleteDialog()
  {
    $this->districtId = null;
    $this->deleteDialog = false;
  }

  public function addDistrict()
  {
    $this->validate([
      'state' => 'required',
      'districtName' => 'required',
      'districtCode' => 'required',
    ]);

    $district = new ModelsDistrict;
    $district->state_id = $this->state;
    $district->name = $this->districtName;
    $district->district_code = $this->districtCode;
    $district->save();
    $this->addDialog = false;
  }

  public function updateDistrict()
  {
    $this->validate([
      'state' => 'required',
      'districtName' => 'required',
      'districtCode' => 'required',
    ]);

    $district = ModelsDistrict::findOrFail($this->districtId);
    $district->state_id = $this->state;
    $district->name = $this->districtName;
    $district->district_code = $this->districtCode;
    $district->save();
    $this->updateDialog = false;
  }

  public function deleteDistrict()
  {
    $info = BasicInfo::where('district_id', $this->districtId)->first();
    $address = Address::where('district_id', $this->districtId)->first();
    $changeAddress = ChangeAddress::where('district_id', $this->districtId)->first();
    $village = Village::where('district_id', $this->districtId)->first();
    $admin = AdminDistrict::where('district_id', $this->districtId)->first();
    $transfer = Transfer::where('district_id', $this->districtId)->first();
    $org = OrganizationAddress::where('district_id', $this->districtId)->first();

    if (!$address && !$info && !$transfer && !$org && !$changeAddress && !$village && !$admin) {
      ModelsDistrict::findOrFail($this->districtId)->delete();
    } else {
      session()->flash('error', 'Permission denied! District is used in another data.');
    }

    $this->deleteDialog = false;
  }

  public function hydrate()
  {
    $this->resetValidation();
  }

  public function render()
  {
    return view('livewire.admin.controls.address.district', [
      'districts' => ModelsDistrict::when($this->st, fn ($q) => $q->where('state_id', $this->st))
        ->when(
          $this->name,
          fn ($q) =>
          $q->where('name', 'like', '%' . $this->name . '%')
            ->orWhere('district_code', 'like', '%' . $this->name . '%')
        )
        ->paginate(10),

      'states' => State::orderBy('name', 'ASC')->get(),
    ]);
  }
}
