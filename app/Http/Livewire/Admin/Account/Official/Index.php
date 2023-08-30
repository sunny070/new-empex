<?php

namespace App\Http\Livewire\Admin\Account\Official;

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
		AdminDistrict::where('admin_id', $this->deletedId)->delete();
		Admin::where('id', $this->deletedId)->delete();

		return redirect(route('admin.official.accounts'));
	}

	public function mount()
	{
		$this->roles = Role::where('id', '!=', 4)->orderBy('name', 'ASC')->get();
	}

	public function render()
	{
		return view('livewire.admin.account.official.index', [
			'admins' => Admin::where('role_id', '!=', 4)
				->when($this->role, fn ($q) => $q->where('role_id', $this->role))
				->when($this->name, fn ($q) => $q->where('name', 'like', '%' . $this->name . '%'))
				->with('district')
				->paginate()
		]);
	}
}
