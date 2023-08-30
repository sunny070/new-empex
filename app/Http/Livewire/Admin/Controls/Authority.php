<?php

namespace App\Http\Livewire\Admin\Controls;

use App\Models\District;
use App\Models\RegisteringAuthority;
use App\Models\RegisteringAuthorityDistrict;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Authority extends Component
{
    use WithFileUploads;

    public $dleoName, $signature;
    public $authorityId;
    public $addAuthorityModal = false;
    public $editAuthorityModal = false;
    public $deleteAuthorityModal = false;
    public $district = [];
    public $name;
    public $alreadyDistricts = [];

    public function hydrate()
    {
        $this->emit('select2AutoInit');
        $this->alreadyDistricts = RegisteringAuthorityDistrict::pluck('district_id');
    }

    public function render()
    {
        return view('livewire.admin.controls.authority', [
            'authorities' => RegisteringAuthority::with('district')
                ->when($this->name, fn ($q) => $q->where('name', 'like', '%' . $this->name . '%'))
                ->paginate('10'),
            'districts' => District::orderBy('name', 'ASC')->whereNotIn('id', $this->alreadyDistricts)->get(),
        ]);
    }

    public function launchAddModal()
    {
        $this->reset([
            'dleoName',
            'signature',
            'district'
        ]);

        $this->addAuthorityModal = true;
    }

    public function addAuthority()
    {
        $this->validate([
            'dleoName' => 'required',
            'signature' => 'required|image|max:2048',
            'district' => 'required',
        ]);

        $regd = new RegisteringAuthority();
        $regd->name = $this->dleoName;
        $regd->signature = $this->signature->storePublicly('authority_signature', 'public');
        $regd->save();

        foreach ($this->district as $dist) {
            $da = new RegisteringAuthorityDistrict();
            $da->registering_authority_id = $regd->id;
            $da->district_id = $dist;
            $da->save();
        }

        $this->addAuthorityModal = false;
    }

    public function openDeleteDialog($id)
    {
        $this->deleteAuthorityModal = true;
        $this->authorityId = $id;
    }

    public function closeDeleteDialog()
    {
        $this->deleteAuthorityModal = false;
    }

    public function deleteAuthority()
    {
        RegisteringAuthorityDistrict::where('registering_authority_id', $this->authorityId)->delete();
        $authority = RegisteringAuthority::where('id', $this->authorityId)->first();
        Storage::disk('public')->delete($authority->signature);
        $authority->delete();

        $this->deleteAuthorityModal = false;
    }
}
