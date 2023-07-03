<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        $title = 'Login';
        return view('auth.login', [
            'title' => $title
        ]);
    }
    public function aksilogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('admin.beranda');
        }

        if (Auth::guard('karyawan')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('karyawan.beranda');
        }
        if (Auth::guard('direksi')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('direksi.beranda');
        }
        if (Auth::guard('kasir')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('kasir.beranda');
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

        return redirect('/');
    }
}
