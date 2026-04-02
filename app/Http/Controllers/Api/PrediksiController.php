<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Prediksi;
use App\Models\Anak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrediksiController extends Controller
{
    public function index()
    {
        $anakIds = Anak::where('user_id', Auth::id())->pluck('_id')->toArray();
        $data = Prediksi::whereIn('id_anak', $anakIds)->with('anak')->get();

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

        // BENTENG KEAMANAN: Cocokkan ID Ibu Login dengan tabel Anak
        $anak = Anak::where('_id', $request->id_anak)->where('user_id', Auth::id())->first();
        if (!$anak) {
            return response()->json(['pesan' => 'Akses Dilarang! Anak ini bukan milik Anda.'], 403);
        }

        $prediksi = Prediksi::create($request->all());

        return response()->json([
            'pesan' => 'Data prediksi berhasil disimpan',
            'data' => $prediksi
        ], 201);
    }

    public function show($id)
    {
        $prediksi = Prediksi::with('anak')->find($id);

        if (!$prediksi || $prediksi->anak->user_id !== Auth::id()) {
            return response()->json(['pesan' => 'Data prediksi tidak ditemukan atau dilarang diakses!'], 403);
        }

        return response()->json([
            'pesan' => 'Detail data prediksi',
            'data' => $prediksi
        ]);
    }

    public function update(Request $request, $id)
    {
        $prediksi = Prediksi::with('anak')->find($id);

        if (!$prediksi || $prediksi->anak->user_id !== Auth::id()) {
            return response()->json(['pesan' => 'Data prediksi tidak ditemukan atau dilarang diakses!'], 403);
        }

        $prediksi->update($request->all());

        return response()->json([
            'pesan' => 'Data prediksi berhasil diperbarui',
            'data' => $prediksi
        ]);
    }

    public function destroy($id)
    {
        $prediksi = Prediksi::with('anak')->find($id);

        if (!$prediksi || $prediksi->anak->user_id !== Auth::id()) {
            return response()->json(['pesan' => 'Data prediksi tidak ditemukan atau dilarang diakses!'], 403);
        }

        $prediksi->delete();

        return response()->json([
            'pesan' => 'Data prediksi berhasil dihapus'
        ]);
    }
}
