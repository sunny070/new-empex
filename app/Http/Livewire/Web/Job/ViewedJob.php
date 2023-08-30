<?php

namespace App\Http\Livewire\Web\Job;

use App\Models\UserJob;
use Livewire\Component;
use Livewire\WithPagination;

class ViewedJob extends Component
{
    use WithPagination;

    public function deleteViewedJob($id)
    {
        UserJob::findOrFail($id)->delete();
    }

    public function render()
    {
        return view('livewire.web.job.viewed-job', [
            'userJobPost' => UserJob::with('job')->where('user_id', auth()->id())->simplePaginate(5)
        ]);
    }
}
