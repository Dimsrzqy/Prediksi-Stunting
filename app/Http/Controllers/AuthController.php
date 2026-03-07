<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ---------------------------------------------
    // FUNGSI REGISTER (Daftar Akun Baru)
    // ---------------------------------------------
public function register(Request $request)
    {
        // 1. Hapus aturan unique
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'role' => 'required'
        ]);

        // 2. Cek manual apakah email sudah ada di database
        $cekEmail = User::where('email', $request->email)->first();
        if ($cekEmail) {
            return response()->json([
                'pesan' => 'Waduh, email ini sudah terdaftar bro!'
            ], 400); // 400 artinya Bad Request
        }

        // 3. Simpan user ke MongoDB
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password, 
            'role' => $request->role
        ]);

        // 4. Buatkan Token API
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'pesan' => 'Alhamdulillah, akun berhasil dibuat!',
            'data' => $user,
            'token' => $token
        ], 201);
    }
    // ---------------------------------------------
    // FUNGSI LOGIN (Masuk Aplikasi)
    // ---------------------------------------------
    public function login(Request $request)
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
}