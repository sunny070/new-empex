<?php

namespace App\Http\Livewire;

use App\Models\JobFile;
use App\Models\JobPost;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class DeletePlacement extends Component
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
        $deletePost = JobPost::query()->findOrFail($this->jobId);
        $this->deleteDialog = false;

        if ($deletePost->attachments()->exists()) {
            $collect = $deletePost->attachments()->pluck('file');
            foreach ($collect as $value) {
                info($value);
                Storage::delete("public/" . $value);
            }
        }

        $deletePost->delete();


        return redirect()->route('jobsPost');
    }

    public function render()
    {
        return view('livewire.delete-job');
    }
}
