<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Prediksi;
use Illuminate\Http\Request;

class PrediksiController extends Controller
{
    public function index()
    {
        $data = Prediksi::with('anak')->get();
        return response()->json([
            'pesan' => 'Berhasil mengambil data prediksi',
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_anak' => 'required',
            'hasil_prediksi' => 'required|string',
            'probabilitas' => 'required|numeric',
            'tanggal_prediksi' => 'required|date',
        ]);

        $prediksi = Prediksi::create($request->all());

        return response()->json([
            'pesan' => 'Data prediksi berhasil disimpan',
            'data' => $prediksi
        ], 201);
    }

    public function show($id)
    {
        $prediksi = Prediksi::with('anak')->find($id);
        
        if (!$prediksi) {
            return response()->json(['pesan' => 'Data prediksi tidak ditemukan!'], 404);
        }

        return response()->json([
            'pesan' => 'Detail data prediksi',
            'data' => $prediksi
        ]);
    }

    public function update(Request $request, $id)
    {
        $prediksi = Prediksi::find($id);
        
        if (!$prediksi) {
            return response()->json(['pesan' => 'Data prediksi tidak ditemukan!'], 404);
        }

        $prediksi->update($request->all());

        return response()->json([
            'pesan' => 'Data prediksi berhasil diperbarui',
            'data' => $prediksi
        ]);
    }

    public function destroy($id)
    {
        $prediksi = Prediksi::find($id);
        
        if (!$prediksi) {
            return response()->json(['pesan' => 'Data prediksi tidak ditemukan!'], 404);
        }

        $prediksi->delete();

        return response()->json([
            'pesan' => 'Data prediksi berhasil dihapus'
        ]);
    }
}
