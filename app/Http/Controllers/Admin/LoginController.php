<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
	public function __construct()
	{
		$this->middleware('guest:admin')->except('logout');
	}

	public function redirectTo()
	{
		$role = Auth::guard('admin')->user()->role_id;

		switch ($role) {
			case '1':
				return '/admin/dashboard';
				break;

			case '2':
				return '/verifier/dashboard';
				break;

			case '3':
				return '/approver/dashboard';
				break;

			case '4':
				return '/employer/dashboard';
				break;

			case '5':
				return '/district-admin/dashboard';
				break;

			default:
				return '/admin';
				break;
		}
	}

	public function showLoginForm()
	{
		if (Auth::guard('admin')->check()) {
			$this->redirectTo();
		}
		return view('auth.login');
	}

	public function login(Request $request)
	{
        Log::info('admin login');
		$this->validate($request, [
			'email' => 'required|email',
			'password' => 'required',
		]);
		if (Auth::guard('admin')->attempt([
			'email' => $request->email,
			'password' => $request->password,
		], $request->remember)) {
			if (Auth::guard('admin')->user()->is_approved != 1) {
				Session::flush();
				return back()->withInput($request->only('email', 'remember'))->with(['status' => 'Your account is not APPROVED yet! Please wait for admin confirmation.']);
			} else {
				$this->redirectTo();
			}
		}
		return back()->withInput($request->only('email', 'remember'))->with(['status' => 'Invalid credentials']);
	}

	public function logout(Request $request)
	{
		Auth::guard('admin')->logout();
		$request->session()->invalidate();
		return redirect()->route('admin.login');
	}
}
