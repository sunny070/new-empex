<?php

namespace App\Http\Livewire\Admin\Controls;

use App\Imports\ArchiveImport;
use App\Imports\UserImport;
use App\Models\Terms as ModelsTerms;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class Terms extends Component
{
	use WithFileUploads;

	public $content;
	public $file;
	public $archiveFile;

	public function hydrate()
	{
		$this->emit('select2AutoInit');
	}

	public function mount()
	{
		$data = ModelsTerms::first();

		if ($data) {
			$this->content = $data->content;
		}
	}

	public function render()
	{
		return view('livewire.admin.controls.terms');
	}

	public function update()
	{
		$this->validate([
			'content' => 'required'
		]);

		$data = ModelsTerms::first();

		if ($data) {
			$data->update([
				'content' => $this->content
			]);
			session()->flash('success', 'Terms and condition updated successfully');
		} else {
			$t = new ModelsTerms();
			$t->content = $this->content;
			$t->save();
			session()->flash('success', 'Terms and condition created successfully');
		}
	}

	public function importExcel()
	{
		$this->validate([
			'file' => 'required'
		]);

		Excel::import(new UserImport, $this->file);

		dd('jobseeker imported successfully');
	}

	public function importArchive()
	{
		$this->validate([
			'archiveFile' => 'required'
		]);

		Excel::import(new ArchiveImport, $this->archiveFile);

		dd('archive jobseeker imported successfully');
	}
}
