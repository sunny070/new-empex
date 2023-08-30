<?php

namespace App\Http\Livewire\Admin\Controls\Organization;

use App\Models\Admin;
use App\Models\Category as ModelsCategory;
use App\Models\JobPost;
use App\Models\Organization;
use App\Models\Type;
use Livewire\Component;
use Livewire\WithPagination;

class Category extends Component
{
	use WithPagination;

	public $categoryName;
	public $categoryId;
	public $addDialog = false;
	public $updateDialog = false;
	public $deleteDialog = false;
	public $name;

	public function openAddDialog()
	{
		$this->categoryName = null;
		$this->addDialog = true;
	}
	public function openUpdateDialog($id, $name)
	{
		$this->updateDialog = true;
		$this->categoryId = $id;
		$this->categoryName = $name;
	}

	public function openDeleteDialog($id)
	{
		$this->categoryId = $id;
		$this->deleteDialog = true;
	}

	public function closeDeleteDialog()
	{
		$this->categoryId = null;
		$this->deleteDialog = false;
	}

	public function addCategory()
	{
		$this->validate([
			'categoryName' => 'required',
		]);

		$state = new ModelsCategory();
		$state->name = $this->categoryName;
		$state->save();
		$this->addDialog = false;
	}

	public function updateCategory()
	{
		$this->validate([
			'categoryName' => 'required',
		]);

		$state = ModelsCategory::findOrFail($this->categoryId);
		$state->name = $this->categoryName;
		$state->save();
		$this->updateDialog = false;
	}

	public function deleteCategory()
	{
		$job = JobPost::where('category_id', $this->categoryId)->first();
		$admin = Admin::where('category_id', $this->categoryId)->first();
		$type = Type::where('category_id', $this->categoryId)->first();
		$org = Organization::where('category_id', $this->categoryId)->first();

		if (!$job && !$admin && !$type && !$org) {
			ModelsCategory::findOrFail($this->categoryId)->delete();
		} else {
			session()->flash('error', 'Permission denied! Category is used in another data.');
		}

		$this->deleteDialog = false;
	}

	public function hydrate()
	{
		$this->resetValidation();
	}

	public function render()
	{
		return view('livewire.admin.controls.organization.category', [
			'categories' => ModelsCategory::when($this->name, fn ($q) => $q->where('name', 'like', '%' . $this->name . '%'))
				->paginate(10),
		]);
	}
}
