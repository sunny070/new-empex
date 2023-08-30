<?php

namespace App\Http\Livewire\Web;

use Livewire\Component;

class PlacementArchive extends Component
{

    public $years = [];

    public $endYears;

    public $months = [
        'January' => 1,
        'February' => 2,
        'March' => 3,
        'April' => 4,
        'May' => 5,
        'June' => 6,
        'July' => 7,
        'August' => 8,
        'September' => 9,
        'October' => 10,
        'November' => 11,
        'December' => 13,
    ];

    public $placements, $district_id;

    public $test = 'test mai2';

    public $year;



    public function mount($placements, $district_id)
    {
        // dd(request());
        $this->year = request()->year;
        $this->placements = collect();
        $this->placements = $placements;
        $this->district_id = $district_id;
    }
    public function render()
    {
        return view('livewire.web.placement-archive');
    }
}
