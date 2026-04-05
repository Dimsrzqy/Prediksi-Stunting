<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProfilIbu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfilIbuController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user && $user->role === 'admin') {
            $profilIbu = ProfilIbu::with('anak')->get();
        } else {
            $profilIbu = ProfilIbu::where('user_id', $user->id)->with('anak')->get();
        }
        return response()->json($profilIbu);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_ibu' => 'nullable|string', // Nullable agar Flutter tidak ditolak
            'usia_ibu' => 'required|integer|min:15',
            'tinggi_ibu' => 'required|numeric|min:100',
            'pendidikan_ibu' => 'required|string|max:255',
            'pekerjaan_ibu' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = Auth::user();
        $data = $request->all();
        $data['user_id'] = $user->id;
        
        // -----------------------------------------------------
        // Fallback: Jika 'nama_ibu' tidak disubmit dari Flutter, salin paksa nama User (Akun Utama)
        // -----------------------------------------------------
        if (!isset($data['nama_ibu']) || empty($data['nama_ibu'])) {
            $data['nama_ibu'] = $user->name;
        }

        $profilIbu = ProfilIbu::create($data);

        return response()->json($profilIbu, 201);
    }

    public function show($id)
    {
        $profilIbu = ProfilIbu::find($id);

        if (!$profilIbu) {
            return response()->json(['message' => 'Profil tidak ditemukan.'], 404);
        }

        // Otorisasi: Pastikan user hanya bisa melihat profil miliknya, KECUALI Admin
        if (Auth::user()->role !== 'admin' && $profilIbu->user_id !== Auth::id()) {
            return response()->json(['message' => 'Akses ditolak.'], 403);
        }

        $profilIbu->load('anak');
        return response()->json($profilIbu);
    }

    public function update(Request $request, $id)
    {
        $profilIbu = ProfilIbu::find($id);

        if (!$profilIbu) {
            return response()->json(['message' => 'Profil tidak ditemukan.'], 404);
        }

        if (Auth::user()->role !== 'admin' && $profilIbu->user_id !== Auth::id()) {
            return response()->json(['message' => 'Akses ditolak.'], 403);
        }

        $validator = Validator::make($request->all(), [
            'nama_ibu' => 'sometimes|nullable|string',
            'usia_ibu' => 'sometimes|required|integer|min:15',
            'tinggi_ibu' => 'sometimes|required|numeric|min:100',
            'pendidikan_ibu' => 'sometimes|required|string|max:255',
            'pekerjaan_ibu' => 'sometimes|required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $dataToUpdate = $request->except('user_id');
        $profilIbu->update($dataToUpdate);

        return response()->json($profilIbu);
    }

    public function destroy($id)
    {
        $profilIbu = ProfilIbu::find($id);

        if (!$profilIbu) {
            return response()->json(['message' => 'Profil tidak ditemukan.'], 404);
        }
        
        if (Auth::user()->role !== 'admin' && $profilIbu->user_id !== Auth::id()) {
            return response()->json(['message' => 'Akses ditolak.'], 403);
        }

        $profilIbu->delete();

        return response()->json(null, 204);
    }
}
