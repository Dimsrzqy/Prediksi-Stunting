<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Anak;
use App\Models\ProfilIbu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfilIbuController extends Controller
{
    /**
     * Display a listing of the resource for the authenticated user.
     */
    public function index()
    {
        $user = Auth::user();
        // Ambil semua id_anak yang dimiliki oleh user
        $anakIds = Anak::where('user_id', $user->id)->pluck('_id');

        // Ambil semua profil ibu yang terkait dengan anak-anak user
        $profilIbu = ProfilIbu::whereIn('id_anak', $anakIds)->with('anak')->get();

        return response()->json($profilIbu);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_anak' => 'required|string',
            'usia_ibu' => 'required|integer|min:15',
            'tinggi_ibu' => 'required|numeric|min:100',
            'pendidikan_ibu' => 'required|string|max:255',
            'pekerjaan_ibu' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = Auth::user();
        $anak = Anak::find($request->id_anak);

        // 1. Validasi: Cek apakah anak ada dan dimiliki oleh user yang sedang login
        if (!$anak || $anak->user_id !== $user->id) {
            return response()->json(['message' => 'Data anak tidak ditemukan'], 403);
        }

        // 2. Validasi: Cek apakah profil untuk anak ini sudah ada
        $existingProfil = ProfilIbu::where('id_anak', $anak->id)->first();
        if ($existingProfil) {
            return response()->json(['message' => 'Profil untuk anak ini sudah ada. Gunakan metode UPDATE untuk mengubah data.'], 409);
        }

        $profilIbu = ProfilIbu::create($request->all());

        return response()->json($profilIbu, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $profilIbu = ProfilIbu::find($id);

        if (!$profilIbu) {
            return response()->json(['message' => 'Profil tidak ditemukan.'], 404);
        }

        // Otorisasi: Pastikan user hanya bisa melihat profil miliknya
        $anak = Anak::find($profilIbu->id_anak);
        if ($anak->user_id !== Auth::id()) {
            return response()->json(['message' => 'Akses ditolak.'], 403);
        }

        $profilIbu->load('anak');
        return response()->json($profilIbu);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $profilIbu = ProfilIbu::find($id);

        if (!$profilIbu) {
            return response()->json(['message' => 'Profil tidak ditemukan.'], 404);
        }

        // Otorisasi: Pastikan user hanya bisa mengubah profil miliknya
        $anak = Anak::find($profilIbu->id_anak);
        if ($anak->user_id !== Auth::id()) {
            return response()->json(['message' => 'Akses ditolak.'], 403);
        }

        $validator = Validator::make($request->all(), [
            'usia_ibu' => 'sometimes|required|integer|min:15',
            'tinggi_ibu' => 'sometimes|required|numeric|min:100',
            'pendidikan_ibu' => 'sometimes|required|string|max:255',
            'pekerjaan_ibu' => 'sometimes|required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // id_anak tidak boleh diubah
        $dataToUpdate = $request->except('id_anak');
        $profilIbu->update($dataToUpdate);

        return response()->json($profilIbu);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $profilIbu = ProfilIbu::find($id);

        if (!$profilIbu) {
            return response()->json(['message' => 'Profil tidak ditemukan.'], 404);
        }
        
        // Otorisasi: Pastikan user hanya bisa menghapus profil miliknya
        $anak = Anak::find($profilIbu->id_anak);
        if ($anak->user_id !== Auth::id()) {
            return response()->json(['message' => 'Akses ditolak.'], 403);
        }

        $profilIbu->delete();

        return response()->json(null, 204);
    }
}
