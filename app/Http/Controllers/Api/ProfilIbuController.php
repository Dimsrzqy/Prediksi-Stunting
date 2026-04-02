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
        $profilIbu = ProfilIbu::where('user_id', $user->id)->with('anak')->get();
        return response()->json($profilIbu);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_ibu' => 'required|string',
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

        $profilIbu = ProfilIbu::create($data);

        return response()->json($profilIbu, 201);
    }

    public function show($id)
    {
        $profilIbu = ProfilIbu::find($id);

        if (!$profilIbu) {
            return response()->json(['message' => 'Profil tidak ditemukan.'], 404);
        }

        // Otorisasi: Pastikan user hanya bisa melihat profil miliknya
        if ($profilIbu->user_id !== Auth::id()) {
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

        if ($profilIbu->user_id !== Auth::id()) {
            return response()->json(['message' => 'Akses ditolak.'], 403);
        }

        $validator = Validator::make($request->all(), [
            'nama_ibu' => 'sometimes|required|string',
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
        
        if ($profilIbu->user_id !== Auth::id()) {
            return response()->json(['message' => 'Akses ditolak.'], 403);
        }

        $profilIbu->delete();

        return response()->json(null, 204);
    }
}
