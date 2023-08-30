<?php

namespace App\Http\Livewire\Admin\Employer;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Department;
use App\Models\District;
use App\Models\Organization;
use App\Models\OrganizationAddress;
use App\Models\Sector;
use App\Models\State;
use App\Models\Type;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class Create extends ModalComponent
{
	use WithFileUploads;

	public $departments;
	public $sectors;
	public $organizationCategoryName;
	public $organizationCategoryId;
	public $organizationTypeName;
	public $organizationTypeId;
	public $department;
	public $sector;
	public $email, $password, $password_confirmation;
	public $step = 1;

	public static function closeModalOnEscape(): bool
	{
		return false;
	}

	public static function closeModalOnClickAway(): bool
	{
		return false;
	}

	public function hydrate()
	{
		$this->resetErrorBag();
	}

	public function mount()
	{
		$organizationCategory = Category::where('id', 3)->first();
		$this->organizationCategoryName = $organizationCategory->name;
		$this->organizationCategoryId = $organizationCategory->id;

		$organizationType = Type::where('id', 11)->first();
		$this->organizationTypeName = $organizationType->name;
		$this->organizationTypeId = $organizationType->id;

		$this->departments = Department::orderBy('name', 'ASC')->get();
		$this->sectors = Sector::orderBy('name', 'ASC')->get();
	}

	public function render()
	{
		return view('livewire.admin.employer.create');
	}

	public function backStep1()
	{
		$this->step = 1;
	}

	public function step2()
	{
		$this->validate([
			'department' => 'required',
			'sector' => 'required',
		]);

		$this->step = 2;
	}

	public function submit()
	{
		$this->validate([
			'email' => 'required|unique:admins,email|email',
			'password' => 'required|confirmed|min:6',
			'password_confirmation' => 'required',
		]);

		$admin = new Admin();
		$admin->email = $this->email;
		$admin->password = $this->password;
		$admin->role_id = 4;
		$admin->is_approved = 1;
		$admin->category_id = $this->organizationCategoryId;
		$admin->save();

		$org = new Organization();
		$org->admin_id = $admin->id;
		$org->category_id = $this->organizationCategoryId;
		$org->type_id = $this->organizationTypeId;
		$org->sector_id = $this->sector;
		$org->department_id = $this->department;
		$org->save();

		$this->closeModal();

		return redirect(route('admin.employer'));
	}
}
