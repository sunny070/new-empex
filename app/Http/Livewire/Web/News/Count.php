<?php

namespace App\Http\Livewire\Web\News;

use App\Models\News;
use Livewire\Component;

class Count extends Component
{
    public $count = 0;

    public function mount()
    {
        $prev = date('Y-m-d H:i:s', strtotime('-7 day', strtotime(now())));
        $this->count = News::whereBetween('created_at', [$prev, now()])->count();
    }

    public function render()
    {
        return view('livewire.web.news.count');
    }
}
