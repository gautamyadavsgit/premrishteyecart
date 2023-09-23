<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.login');
    }
    public function login(Request $request)
    {
        $credentials =  $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required',]
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('admin/dashboard');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('admin.login'));
    }
}
