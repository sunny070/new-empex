<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use LivewireUI\Modal\ModalComponent;

class ResetPassword extends ModalComponent
{
	public $email;

	public function render()
	{
		return view('livewire.reset-password');
	}

	public static function closeModalOnEscape(): bool
	{
		return false;
	}

	public static function closeModalOnClickAway(): bool
	{
		return false;
	}

	public function submit()
	{
		$this->validate([
			'email' => 'required|email|exists:admins,email'
		]);

		$token = Str::random(64);
		$now = Carbon::now();

		DB::table('password_resets')->insert([
			'email' => $this->email,
			'token' => $token,
			'created_at' => $now
		]);

		Mail::send('email.forget-password', ['token' => $token, 'date' => $now->addHour()], function ($message) {
			$message->to($this->email);
			$message->subject('Reset Password');
		});

		session()->flash('success', 'We have emailed your password reset link. Please check your inbox!');
	}
}
