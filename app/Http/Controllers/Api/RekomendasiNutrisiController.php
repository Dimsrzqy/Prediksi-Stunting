<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\RekomendasiNutrisi;
use Illuminate\Http\Request;

class RekomendasiNutrisiController extends Controller
{
    public function index()
    {
        $data = RekomendasiNutrisi::with('nutrisi')->get();
        return response()->json([
            'pesan' => 'Berhasil mengambil data rekomendasi nutrisi',
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_risiko' => 'required|string',
            'id_nutrisi' => 'required'
        ]);

        $rekomendasi = RekomendasiNutrisi::create($request->all());

        return response()->json([
            'pesan' => 'Data rekomendasi nutrisi berhasil disimpan',
            'data' => $rekomendasi
        ], 201);
    }

    public function show($id)
    {
        $rekomendasi = RekomendasiNutrisi::with('nutrisi')->find($id);

        if (!$rekomendasi) {
            return response()->json(['pesan' => 'Data rekomendasi nutrisi tidak ditemukan!'], 404);
        }

        return response()->json([
            'pesan' => 'Detail data rekomendasi nutrisi',
            'data' => $rekomendasi
        ]);
    }

    public function update(Request $request, $id)
    {
        $rekomendasi = RekomendasiNutrisi::find($id);

        if (!$rekomendasi) {
            return response()->json(['pesan' => 'Data rekomendasi nutrisi tidak ditemukan!'], 404);
        }

        $request->validate([
            'kategori_risiko' => 'sometimes|required|string',
            'id_nutrisi' => 'sometimes|required'
        ]);

        $rekomendasi->update($request->all());

        return response()->json([
            'pesan' => 'Data rekomendasi nutrisi berhasil diperbarui',
            'data' => $rekomendasi
        ]);
    }

    public function destroy($id)
    {
        $rekomendasi = RekomendasiNutrisi::find($id);

        if (!$rekomendasi) {
            return response()->json(['pesan' => 'Data rekomendasi nutrisi tidak ditemukan!'], 404);
        }

        $rekomendasi->delete();

        return response()->json([
            'pesan' => 'Data rekomendasi nutrisi berhasil dihapus'
        ]);
    }
}
