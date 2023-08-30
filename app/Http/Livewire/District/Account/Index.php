<?php

namespace App\Http\Livewire\District\Account;

use App\Models\Admin;
use App\Models\AdminDistrict;
use App\Models\Role;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
	use WithPagination;

	public $roles;
	public $role;
	public $name;
	public $authDistricts;
	public $adminIds;
	public $deletedId;
	public $deleteDialog = false;

	public function openDeleteDialog($id)
	{
		$this->deletedId = $id;
		$this->deleteDialog = true;
	}

	public function closeDeleteDialog()
	{
		$this->deletedId = null;
		$this->deleteDialog = false;
	}

	public function deleteAdmin()
	{
		AdminDistrict::where('admin_id', $this->deletedId)->whereIn('district_id', $this->authDistricts)->delete();

		$am = AdminDistrict::where('admin_id', $this->deletedId)->first();
		if (!$am) {
			Admin::where('id', $this->deletedId)->delete();
		}

		return redirect(route('district-admin.account'));
	}

	public function mount()
	{
		$this->authDistricts = AdminDistrict::where('admin_id', auth()->guard('admin')->id())->pluck('district_id')->toArray();
		$this->roles = Role::whereIn('id', [2, 3])->orderBy('name', 'ASC')->get();
		$this->adminIds = AdminDistrict::whereIn('district_id', $this->authDistricts)->pluck('admin_id');
	}

	public function render()
	{
		return view('livewire.district.account.index', [
			'admins' => Admin::whereIn('role_id', [2, 3])
				->whereIn('id', $this->adminIds)
				->when($this->role, fn ($q) => $q->where('role_id', $this->role))
				->when($this->name, fn ($q) => $q->where('name', 'like', '%' . $this->name . '%'))
				->with('district')
				->paginate()
		]);
	}
}
