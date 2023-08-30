<?php

namespace App\Http\Livewire;

use App\Models\JobPost;
use App\Models\News;
use Livewire\Component;

class DeleteNews extends Component
{
    public $jobId;
    public $deleteDialog = false;

    public function mount($id)
    {
        $this->jobId = $id;
    }

    public function toggleDeleteDialog($jobId)
    {
        $this->jobId = $jobId;
        $this->deleteDialog = true;
    }

    public function cancelDelete()
    {
        $this->deleteDialog = false;
    }

    public function deleteJob()
    {
        News::findOrFail($this->jobId)->delete();
        $this->deleteDialog = false;
        return redirect()->route('employeeNews');
    }

    public function render()
    {
        return view('livewire.delete-news');
    }
}
