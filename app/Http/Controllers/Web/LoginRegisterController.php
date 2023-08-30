<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginRegisterController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect(route('auth.dashboard'));
        }

        return view('web.login');
    }

    public function signup()
    {
        if (Auth::check()) {
            return redirect(route('auth.dashboard'));
        }

        return view('web.signup');
    }

    public function logout()
    {
        Auth::logout(auth()->user());
        return redirect(route('web.home'));
    }

    public function registration(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
        ])->validate();

        $admin = new Admin();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->role_id = 4;
        $admin->password = $request->password;
        $admin->save();

        return redirect(route('admin.login'));
    }
}
