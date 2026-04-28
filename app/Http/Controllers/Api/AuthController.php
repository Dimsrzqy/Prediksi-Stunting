<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

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
            'no_hp' => 'required|string',
            'email' => 'required|email',
            'password' => [
                'required',
                'min:8',
                'regex:/[a-zA-Z]/', // ada huruf
                'regex:/[0-9]/',    // ada angka
                'confirmed',
            ],
        ]);

        // 2. Cek manual apakah email sudah ada di database
        $cekEmail = User::where('email', $request->email)->first();
        if ($cekEmail) {
            return response()->json([
                'pesan' => 'email ini sudah terdaftar!'
            ], 400); 
        }

        $cekNoHp = User::where('no_hp', $request->no_hp)->first();
        if ($cekNoHp) {
            return response()->json([
                'pesan' => 'nomor hp ini sudah dipakai!'
            ], 400); 
        }

        // 3. Simpan user ke MongoDB
        $user = User::create([
            'name' => $request->name,
            'no_hp' => $request->no_hp,
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
    // FUNGSI LOGOUT API (Cabut Token Sanctum)
    // ---------------------------------------------
    public function logoutApi(Request $request)
    {
        // Hapus token yang sedang digunakan (current token)
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'pesan' => 'Logout berhasil. Token telah dicabut dari server.'
        ]);
    }
    // ---------------------------------------------
    // FUNGSI LOGIN (Masuk Aplikasi) - API
    // ---------------------------------------------
    public function loginApi(Request $request)
    {
        // 1. Cek isian
        $request->validate([
            'identifier' => 'required',
            'password' => 'required'
        ]);

        // 2. Cari user berdasarkan email atau no_hp di database
        $fieldType = filter_var($request->identifier, FILTER_VALIDATE_EMAIL) ? 'email' : 'no_hp';
        $user = User::where($fieldType, $request->identifier)->first();

        // 3. Cek apakah user ada DAN passwordnya cocok (Hash::check)
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'pesan' => 'Email/Nomor HP atau Password salah!'
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
            $user = Auth::user();

            // Cek apakah role-nya login sebagai admin
            if ($user->role !== 'admin') {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()->withErrors([
                    'email' => 'Anda bukan admin! Akses web dibatasi.',
                ])->onlyInput('email');
            }

            $request->session()->regenerate();
            
            // Berhasil login sebagai admin
            return redirect()->route('dashboard');
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