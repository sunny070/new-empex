<?php

namespace App\Http\Livewire\Web\Job;

use App\Models\UserJobNcs;
use Livewire\WithPagination;

use Livewire\Component;

class ViewedJobNcs extends Component
{
    use WithPagination;

    public function deleteViewedJob($id)
    {
        UserJobNcs::findOrFail($id)->delete();
    }
    public function render()
    {

        return view('livewire.web.job.viewed-job-ncs', [
            'userJobPostNcs' => UserJobNcs::with('job')->where('user_id', auth()->id())->simplePaginate(5)
        ]);
        // return view('livewire.web.job.viewed-job-ncs');
    }
}
