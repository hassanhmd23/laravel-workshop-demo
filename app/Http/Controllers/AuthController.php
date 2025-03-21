<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended();
        }

        return back()->with(
            'error', 'Incorrect Email/Password',
        );
    }

    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('login');
    }
}
