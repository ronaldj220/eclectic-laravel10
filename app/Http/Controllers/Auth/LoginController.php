<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function home()
    {
        // Pemilahan kalau dia sudah login atau belum
        if (Auth::check()) {
            // return route('login');

            if (Auth::guard('web')) {
                return redirect()->route('admin.beranda');
            }

            if (Auth::guard('karyawan')) {
                return redirect()->route('karyawan.beranda');
            }
            if (Auth::guard('direksi')) {
                return redirect()->route('direksi.beranda');
            }
            if (Auth::guard('kasir')) {
                return redirect()->route('kasir.beranda');
            }
        } else {
            return redirect(route('login'));
        }
    }
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

        $remember = $request->has('remember');
        // dd($remember);

        if (Auth::guard('web')->attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return redirect()->route('admin.beranda');
        }

        if (Auth::guard('karyawan')->attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return redirect()->route('karyawan.beranda');
            // dd('login berhasil');
        }
        if (Auth::guard('direksi')->attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return redirect()->route('direksi.beranda');
            // dd('login berhasil');
        }
        if (Auth::guard('kasir')->attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return redirect()->route('kasir.beranda');
            // dd('login berhasil');
        }
        return back()->withErrors([
            'email' => 'Email atau Password salah! Silahkan Lakukan Login Kembali.',
        ]);
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
