<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
	public function showResetPasswordForm($token)
	{
		return view('forgot-password-link', ['token' => $token]);
	}

	public function submitResetPasswordForm(Request $request)
	{
		$request->validate([
			'email' => 'required|email|exists:admins,email',
			'password' => 'required|string|min:6|confirmed',
			'password_confirmation' => 'required'
		]);

		$updatePassword = DB::table('password_resets')
			->where([
				'email' => $request->email,
				'token' => $request->token
			])
			->first();

		if (!$updatePassword) {
			return back()->withInput()->with('error', 'This password reset token is invalid.');
		}

		if (now() >= Carbon::parse($updatePassword->created_at)->addHour()) {
			return back()->withInput()->with('error', 'This password reset token is expired.');
		}

		Admin::where('email', $request->email)->update(['password' => Hash::make($request->password)]);

		DB::table('password_resets')->where(['email' => $request->email, 'token' => $request->token])->delete();

		return redirect('/admin')->with('status', 'Your password has been changed!');
	}
}
