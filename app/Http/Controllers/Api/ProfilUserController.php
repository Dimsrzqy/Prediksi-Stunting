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
    // Fungsi Menyimpan Tulisan Editan Baru Termasuk Password
    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        $rules = [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,'.$user->id.',_id'
        ];

        if ($request->filled('password')) {
            $rules['password'] = 'min:6';
        }

        $request->validate($rules);

        $data = $request->only(['name', 'email']);
        
        if ($request->filled('password')) {
            $data['password'] = \Illuminate\Support\Facades\Hash::make($request->password);
        }

        $user->update($data);

        return response()->json([
            'pesan' => 'Profil berhasil diperbarui dengan mulus!',
            'data' => $user
        ]);
    }
}
