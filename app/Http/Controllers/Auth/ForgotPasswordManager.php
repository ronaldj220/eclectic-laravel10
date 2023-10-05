<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class ForgotPasswordManager extends Controller
{
    public function forgotPassword()
    {
        $title = 'Lupa Password';
        return view('auth.forgot-password', [
            'title' => $title
        ]);
    }

    public function forgotPasswordPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:user'
        ], [
            'email.exists' => 'Email tidak terdaftar.'
        ]);

        $token = Str::random(64);
        // dd($token);



        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send("auth.email.forgot-password", ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject("Reset Password");
        });

        return redirect()->to(route('forgot-password'))->with('success', 'Kami Telah Mengirimkan Email untuk Reset Password');
    }

    public function resetPassword($token)
    {
        $title = 'Reset Password';

        return view('auth.new-password', compact('token', 'title'));
    }

    public function resetPasswordPost(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email|exists:user',
                'password' => 'required|string|min:6|confirmed',
                'confirm_password' => 'required'
            ]);

            $updatedPassword = DB::table('password_reset_tokens')
                ->where([
                    'email' => $request->email,
                    'token' => $request->token
                ])->first();
            if (!$updatedPassword) {
                return redirect()->to(route('reset-password'))->with('error', 'Invalid');
            }

            User::where('email', $request->email)
                ->update(['password' => Hash::make($request->password)]);

            DB::table('password_reset_tokens')->where(['email' => $request->email])->delete();

            return redirect()->to(route('login'))->with('success', 'Password reset success');
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
