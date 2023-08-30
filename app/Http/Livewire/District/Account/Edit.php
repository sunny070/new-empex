<?php

namespace App\Http\Livewire\District\Account;

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
	public $authDistricts;

	public function submit()
	{
		$this->validate([
			'name' => 'required',
			'email' => 'required|unique:admins,email,' . $this->editedId,
			'contact' => 'required|digits:10|unique:admins,contact,' . $this->editedId,
			'role' => 'required',
			'district' => 'required',
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

		AdminDistrict::where('admin_id', $admin->id)->whereIn('district_id', $this->authDistricts)->delete();
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

	public function mount($id)
	{
		$this->authDistricts = AdminDistrict::where('admin_id', auth()->guard('admin')->id())->pluck('district_id')->toArray();
		$this->roles = Role::whereIn('id', [2, 3])->orderBy('name', 'ASC')->get();
		$this->districts = District::whereIn('id', $this->authDistricts)->get();

		$admin = Admin::where('id', $id)->with('district')->first();
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
		return view('livewire.district.account.edit');
	}
}
