<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilUserController extends Controller
{
    // Fungsi Menarik Data Diri (Bunda)
    public function show()
    {
        return response()->json([
            'pesan' => 'Berhasil mengambil profil Bunda',
            'data' => Auth::user()
        ]);
    }

    // Fungsi Menyimpan Tulisan Editan Baru
    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string',
            // Pengecualian unik untuk email aslinya sendiri (Biar tidak dibilang kembar saat dia cuma ganti nama)
            'email' => 'required|email|unique:users,email,'.$user->id.',_id'
        ]);

        $user->update($request->only(['name', 'email']));

        return response()->json([
            'pesan' => 'Profil berhasil diperbarui dengan mulus!',
            'data' => $user
        ]);
    }
}
