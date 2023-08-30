<?php

namespace App\Http\Livewire\Admin;

use App\Models\Terms;
use LivewireUI\Modal\ModalComponent;

class TermsAndCondition extends ModalComponent
{
	public $terms;

	public static function closeModalOnEscape(): bool
	{
		return false;
	}

	public static function closeModalOnClickAway(): bool
	{
		return false;
	}

	public function mount()
	{
		$this->terms = Terms::first();
	}

	public function render()
	{
		return view('livewire.admin.terms-and-condition');
	}
}
