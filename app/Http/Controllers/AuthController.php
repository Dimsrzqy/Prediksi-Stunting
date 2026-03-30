<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ---------------------------------------------
    // FUNGSI REGISTER (Daftar Akun Baru) - API
    // ---------------------------------------------
    public function registerApi(Request $request)
    {
        // 1. Validasi HANYA data yang dikirim dari Flutter
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|min:6',
            // Aturan 'role' Kakak hapus karena Flutter nggak ngirim data ini
        ]);

        // 2. Cek manual apakah email sudah ada di database
        $cekEmail = User::where('email', $request->email)->first();
        if ($cekEmail) {
            return response()->json([
                'pesan' => 'Waduh, email ini sudah terdaftar bro!'
            ], 400); 
        }

        // 3. Simpan user ke MongoDB
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            // WAJIB pakai Hash::make biar passwordnya aman & bisa dipakai login!
            'password' => Hash::make($request->password), 
            'role' => 'user' // Kita set 'user' otomatis dari backend
        ]);

        // 4. Buatkan Token API
        $token = $user->createToken('auth_token')->plainTextToken;

        // Bikin status code 200/201 biar dibaca "Sukses" sama Flutter
        return response()->json([
            'pesan' => 'akun berhasil dibuat!',
            'data' => $user,
            'token' => $token
        ], 201); 
    }
    // ---------------------------------------------
    // FUNGSI LOGIN (Masuk Aplikasi) - API
    // ---------------------------------------------
    public function loginApi(Request $request)
    {
        // 1. Cek isian
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // 2. Cari user berdasarkan email di database
        $user = User::where('email', $request->email)->first();

        // 3. Cek apakah user ada DAN passwordnya cocok (Hash::check)
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'pesan' => 'Waduh, Email atau Password salah bro!'
            ], 401);
        }

        // 4. Jika cocok, buatkan Token API baru
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'pesan' => 'Login sukses! Selamat datang, ' . $user->name,
            'token' => $token,
            'role' => $user->role
        ]);
    }

    // ---------------------------------------------
    // FUNGSI WEB (Tampil Form & Proses Web)
    // ---------------------------------------------
    
    // Tampilkan halaman register
    public function create()
    {
        return view('auth.register');
    }

    // Proses register untuk web
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), 
            'role' => 'user'
        ]);

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat, silakan login!');
    }

    // Tampilkan halaman login
    public function login()
    {
        return view('auth.login');
    }

    // Proses login untuk web
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Redirect ke halaman dashboard
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah!',
        ])->onlyInput('email');
    }

    // Proses logout untuk web
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}