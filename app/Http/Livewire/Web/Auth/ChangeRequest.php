<?php

namespace App\Http\Livewire\Web\Auth;

use App\Models\BasicInfo;
use Carbon\Carbon;
use Livewire\Component;

class ChangeRequest extends Component
{
    public $step = 1;
    public $info;
    public $check;
    public $card;
    public $canSubmit = false;



    protected $listeners = ['stepIncrement', 'stepDecrement'];

    public function stepIncrement()
    {
        $this->step++;
        $this->saveStep();
    }

    public function stepDecrement()
    {
        $this->step--;
        $this->saveStep();
    }

    public function saveStep()
    {
        $in = BasicInfo::where('user_id', auth()->id())->latest('updated_at')->first();
        $in->step = $this->step;
        $in->save();
    }

    public function mount()
    {
        $this->info = BasicInfo::where('user_id', auth()->id())->latest('updated_at')->first();
        $this->card = BasicInfo::where('user_id', auth()->id())->where('status', 'Approved')->latest('card_valid_till')->first() ? true : false;

        $basic = BasicInfo::query()
            ->where('user_id', auth()->id())
            ->whereDate('card_valid_till', '<', now())
            ->where('status', 'Approved')
            ->latest('card_valid_till')

            ->first();

        if ($basic) {

            $this_month = Carbon::parse($basic->card_valid_till); // returns 2019-07-01
            $validDay = Carbon::parse($basic->card_valid_till);
            $start_month = Carbon::parse(now()); // returns 2019-06-01

            // if (($start_month->diffInMonths($this_month)  >= 3) &&  now()->format('d') > $validDay) {
            if (($start_month->floatDiffInRealMonths($this_month)  >= 3)) {
                // $basic->canEdit=true;
                $basic->is_paid = false;
                $basic->step = 1;
                $this->step = 1;
                $basic->save();
                $this->canSubmit = true;
            }
        }

        // dd($this->canSubmit);




        // if ($this->info) {
        // 	$this->step = $this->info->step;
        // }
    }

    public function render()
    {
        return view('livewire.web.auth.change-request');
    }
}
