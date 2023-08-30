<?php

namespace App\Http\Livewire\District\Account;

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

	public function submit()
	{
		$this->validate([
			'name' => 'required',
			'email' => 'required|unique:admins,email',
			'contact' => 'required|unique:admins,contact|digits:10',
			'password' => 'required',
			'role' => 'required',
			'district' => 'required',
		]);

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

		return redirect(route('district-admin.account'));
	}

	public static function closeModalOnEscape(): bool
	{
		return false;
	}

	public static function closeModalOnClickAway(): bool
	{
		return false;
	}

	public function mount()
	{
		$authDistricts = AdminDistrict::where('admin_id', auth()->guard('admin')->id())->pluck('district_id')->toArray();
		$this->roles = Role::whereIn('id', [2, 3])->orderBy('name', 'ASC')->get();
		$this->districts = District::whereIn('id', $authDistricts)->get();
	}


	public function hydrate()
	{
		$this->resetValidation();
		$this->emit('select2AutoInit');
	}

	public function render()
	{
		return view('livewire.district.account.create');
	}
}
