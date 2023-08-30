<?php

namespace App\Http\Livewire\Web;

use App\Models\OnGoingApplication;
use Livewire\Component;

class TrackStatus extends Component
{
    public $ongoing;
    protected $listeners = ['openOngoingApplication'];

    public function openOngoingApplication($id)
    {
        $this->ongoing = OnGoingApplication::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.web.track-status');
    }
}
