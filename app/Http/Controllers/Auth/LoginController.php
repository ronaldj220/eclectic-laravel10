<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function home()
    {
        if (Auth::check()) {
            // dd(Auth::user()->role_has_user[0]->fk_role);
            if (Auth::user()->role_has_user[0]->fk_role == 1) {
                return redirect()->route('admin.beranda');
            } elseif (Auth::user()->role_has_user[0]->fk_role == 2) {
                return redirect()->route('karyawan.beranda');
            } elseif (Auth::user()->role_has_user[0]->fk_role == 3) {
                return redirect()->route('kasir.beranda');
            } elseif (Auth::user()->role_has_user[0]->fk_role == 4) {
                return redirect()->route('direksi.beranda');
            }
        } else {
            return redirect()->route('login');
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

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->route('home');
        } else {
            return back()->withErrors([
                'email' => 'Email atau Password salah! Silahkan Lakukan Login Kembali.',
            ]);
        }


        // if (Auth::guard('karyawan')->attempt($credentials, $remember)) {
        //     $request->session()->regenerate();

        //     return redirect()->route('karyawan.beranda');
        //     // dd('login berhasil');
        // }
        // if (Auth::guard('direksi')->attempt($credentials, $remember)) {
        //     $request->session()->regenerate();

        //     return redirect()->route('direksi.beranda');
        //     // dd('login berhasil');
        // }
        // if (Auth::guard('kasir')->attempt($credentials, $remember)) {
        //     $request->session()->regenerate();

        //     return redirect()->route('kasir.beranda');
        //     // dd('login berhasil');
        // }
        // return back()->withErrors([
        //     'email' => 'Email atau Password salah! Silahkan Lakukan Login Kembali.',
        // ]);
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
