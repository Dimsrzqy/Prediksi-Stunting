<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak terdaftar.']);
        }

        // Generate token manual untuk simulasi
        $token = Password::broker()->createToken($user);

        // Langsung redirect ke halaman ganti password (simulasi)
        return redirect()->route('password.reset', [
            'token' => $token,
            'email' => $request->email
        ])->with('status', 'Token otomatis terisi! Silakan ganti password dalam 1 menit.');
    }
}
