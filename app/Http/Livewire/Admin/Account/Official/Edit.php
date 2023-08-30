<?php

namespace App\Http\Livewire\Admin\Account\Official;

use App\Models\Admin;
use App\Models\AdminDistrict;
use App\Models\District;
use App\Models\Role;
use LivewireUI\Modal\ModalComponent;

class Edit extends ModalComponent
{
    public $roles;
    public $districts;
    public $name, $role, $email, $password, $editedId, $contact;
    public $district = [];

    protected $messages = [
        'district.required_if' => 'District field is required if role is not Superadmin',
    ];

    public function submit()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|unique:admins,email,' . $this->editedId,
            'contact' => 'required|digits:10|unique:admins,contact,' . $this->editedId,
            'role' => 'required',
            'district' => 'required_if:role,2,3,5',
        ]);

        $admin = Admin::findOrFail($this->editedId);
        $admin->name = $this->name;
        $admin->email = $this->email;
        $admin->contact = $this->contact;
        if ($this->password != null) {
            $this->validate([
                'password' => 'required',
            ]);

            $admin->password = $this->password;
        }
        $admin->role_id = $this->role;
        $admin->save();

        AdminDistrict::where('admin_id', $admin->id)->delete();
        foreach ($this->district as $dist) {
            $adminDistrict = new AdminDistrict();
            $adminDistrict->admin_id = $admin->id;
            $adminDistrict->district_id = $dist;
            $adminDistrict->save();
        }

        $this->closeModal();

        return redirect(route('admin.official.accounts'));
    }

    public static function closeModalOnEscape(): bool
    {
        return false;
    }

    public static function closeModalOnClickAway(): bool
    {
        return false;
    }

    public function updatedRole()
    {
        if ($this->role != '1') {
            $this->districts = District::get();
        } else {
            $this->districts = collect();
            $this->district = [];
        }
    }

    public function mount($id)
    {
        $this->roles = Role::where('id', '!=', 4)->get();

        $admin = Admin::where('id', $id)->with('district')->first();
        if ($admin->role_id != 1) {
            $this->districts = District::get();
        } else {
            $this->districts = collect();
        }

        $this->editedId = $id;
        $this->name = $admin->name;
        $this->email = $admin->email;
        $this->role = $admin->role_id;
        $this->contact = $admin->contact;
        foreach ($admin->district as $dist) {
            $this->district[] = $dist->id;
        }
    }

    public function hydrate()
    {
        $this->resetValidation();
        $this->emit('select2AutoInit');
    }

    public function render()
    {
        return view('livewire.admin.account.official.edit');
    }
}
