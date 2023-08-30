<?php

namespace App\Http\Livewire\Admin\Controls\Organization;

use App\Models\Category;
use App\Models\JobPost;
use App\Models\Organization;
use App\Models\Type as ModelsType;
use Livewire\Component;
use Livewire\WithPagination;

class Type extends Component
{
	use WithPagination;

	public $typeName;
	public $typeId;
	public $category;
	public $addDialog = false;
	public $updateDialog = false;
	public $deleteDialog = false;
	public $name;
	public $cate;

	public function openAddDialog()
	{
		$this->typeName = null;
		$this->addDialog = true;
	}
	public function openUpdateDialog($id, $name, $category)
	{
		$this->updateDialog = true;
		$this->typeId = $id;
		$this->typeName = $name;
		$this->category = $category;
	}

	public function openDeleteDialog($id)
	{
		$this->typeId = $id;
		$this->deleteDialog = true;
	}

	public function closeDeleteDialog()
	{
		$this->typeId = null;
		$this->deleteDialog = false;
	}

	public function addSubject()
	{
		$this->validate([
			'category' => 'required',
			'typeName' => 'required',
		]);

		$subject = new ModelsType();
		$subject->category_id = $this->category;
		$subject->name = $this->typeName;
		$subject->save();
		$this->addDialog = false;
	}

	public function updateSubject()
	{
		$this->validate([
			'category' => 'required',
			'typeName' => 'required',
		]);

		$subject = ModelsType::findOrFail($this->typeId);
		$subject->category_id = $this->category;
		$subject->name = $this->typeName;
		$subject->save();
		$this->updateDialog = false;
	}

	public function deleteSubject()
	{
		$job = JobPost::where('type_id', $this->typeId)->first();
		$org = Organization::where('type_id', $this->typeId)->first();

		if (!$job && !$org) {
			ModelsType::findOrFail($this->typeId)->delete();
		} else {
			session()->flash('error', 'Permission denied! Type is used in another data.');
		}

		$this->deleteDialog = false;
	}

	public function hydrate()
	{
		$this->resetValidation();
	}

	public function render()
	{
		return view('livewire.admin.controls.organization.type', [
			'types' => ModelsType::when($this->name, fn ($q) => $q->where('name', 'like', '%' . $this->name . '%'))
				->when($this->cate, fn ($q) => $q->where('category_id', $this->cate))
				->paginate(10),
			'categories' => Category::get(),
		]);
	}
}
