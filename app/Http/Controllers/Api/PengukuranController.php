<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pengukuran;
use Illuminate\Http\Request;

class PengukuranController extends Controller
{
    public function index()
    {
        // Secara ideal hanya menampilkan pengukuran anak sesuai relasi milik ibu yang login, tapi ini contoh dasar
        $data = Pengukuran::with('anak')->get();
        return response()->json([
            'pesan' => 'Berhasil mengambil data pengukuran anak',
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_anak' => 'required',
            'umur_bulan' => 'required|numeric',
            'tinggi_badan' => 'required|numeric',
            'berat_badan' => 'required|numeric',
            'tanggal_ukur' => 'required|date',
        ]);

        $pengukuran = Pengukuran::create($request->all());

        return response()->json([
            'pesan' => 'Data pengukuran berhasil disimpan',
            'data' => $pengukuran
        ], 201);
    }

    public function show($id)
    {
        $pengukuran = Pengukuran::with('anak')->find($id);

        if (!$pengukuran) {
            return response()->json(['pesan' => 'Data pengukuran tidak ditemukan!'], 404);
        }

        return response()->json([
            'pesan' => 'Detail data pengukuran',
            'data' => $pengukuran
        ]);
    }

    public function update(Request $request, $id)
    {
        $pengukuran = Pengukuran::find($id);

        if (!$pengukuran) {
            return response()->json(['pesan' => 'Data pengukuran tidak ditemukan!'], 404);
        }

        $pengukuran->update($request->all());

        return response()->json([
            'pesan' => 'Data pengukuran berhasil diperbarui',
            'data' => $pengukuran
        ]);
    }

    public function destroy($id)
    {
        $pengukuran = Pengukuran::find($id);

        if (!$pengukuran) {
            return response()->json(['pesan' => 'Data pengukuran tidak ditemukan!'], 404);
        }

        $pengukuran->delete();

        return response()->json([
            'pesan' => 'Data pengukuran berhasil dihapus'
        ]);
    }
}
