<?php

namespace App\Http\Livewire\Admin\Account\Expired;

use App\Models\Admin;
use App\Models\AdminDistrict;
use App\Models\District;
use App\Models\Role;
use LivewireUI\Modal\ModalComponent;

class Create extends ModalComponent
{
    public $roles;
    public $districts;
    public $name, $role, $email, $password, $contact;
    public $district = [];

    protected $rules = [
        'name' => 'required',
        'email' => 'required|unique:admins,email',
        'contact' => 'required|unique:admins,contact|digits:10',
        'password' => 'required',
        'role' => 'required',
        'district' => 'required_if:role,2,3,5',
    ];

    protected $messages = [
        'district.required_if' => 'District field is required if role is not Superadmin',
    ];

    public function submit()
    {
        $this->validate();

        $admin = new Admin();
        $admin->name = $this->name;
        $admin->email = $this->email;
        $admin->password = $this->password;
        $admin->contact = $this->contact;
        $admin->role_id = $this->role;
        $admin->is_approved = 1;
        $admin->save();

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

    public function mount()
    {
        $this->roles = Role::where('id', '!=', 4)->orderBy('name', 'ASC')->get();
        $this->districts = District::get();
    }


    public function hydrate()
    {
        $this->resetValidation();
        $this->emit('select2AutoInit');
    }

    public function render()
    {
        return view('livewire.admin.account.official.create');
    }
}
