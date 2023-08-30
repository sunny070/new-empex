<?php

namespace App\Http\Livewire\Admin;

use App\Models\JobPost;
use Livewire\Component;

class ViewJob extends Component
{
	public $job;

	public function mount($id)
	{
		$this->job = JobPost::with('attachments')->findOrFail($id);
	}

	public function render()
	{
		return view('livewire.admin.view-job');
	}

	public function approved()
	{
		$j = JobPost::where('id', $this->job->id)->first();
		$j->published = 1;
		$j->save();

		return redirect(route('jobsPost'));
	}
}
