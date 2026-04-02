<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pengukuran;
use App\Models\Anak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengukuranController extends Controller
{
    public function index()
    {
        // Hanya ambil List Anak yang dimiliki si Ibu
        $anakIds = Anak::where('user_id', Auth::id())->pluck('_id')->toArray();

        // Cari pengukuran yang bersangkutan dengan List Anak tersebut
        $data = Pengukuran::whereIn('id_anak', $anakIds)->with('anak')->get();
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

        // CEK SISTEM KEAMANAN: Apakah Anak ini benar-benar milik user yang Login?
        $anak = Anak::where('_id', $request->id_anak)->where('user_id', Auth::id())->first();
        if (!$anak) {
            return response()->json(['pesan' => 'Akses Dilarang! Anak ini bukan milik Anda.'], 403);
        }

        $pengukuran = Pengukuran::create($request->all());

        return response()->json([
            'pesan' => 'Data pengukuran berhasil disimpan',
            'data' => $pengukuran
        ], 201);
    }

    public function show($id)
    {
        $pengukuran = Pengukuran::with('anak')->find($id);

        // Jika data hilang ATAU anak yg dicek bukan mili Auth
        if (!$pengukuran || $pengukuran->anak->user_id !== Auth::id()) {
            return response()->json(['pesan' => 'Data pengukuran tidak ditemukan atau Anda dilarang mengakses!'], 403);
        }

        return response()->json([
            'pesan' => 'Detail data pengukuran',
            'data' => $pengukuran
        ]);
    }

    public function update(Request $request, $id)
    {
        $pengukuran = Pengukuran::with('anak')->find($id);

        if (!$pengukuran || $pengukuran->anak->user_id !== Auth::id()) {
            return response()->json(['pesan' => 'Data pengukuran tidak ditemukan atau Anda dilarang mengakses!'], 403);
        }

        $pengukuran->update($request->all());

        return response()->json([
            'pesan' => 'Data pengukuran berhasil diperbarui',
            'data' => $pengukuran
        ]);
    }

    public function destroy($id)
    {
        $pengukuran = Pengukuran::with('anak')->find($id);

        if (!$pengukuran || $pengukuran->anak->user_id !== Auth::id()) {
            return response()->json(['pesan' => 'Data pengukuran tidak ditemukan atau Anda dilarang mengakses!'], 403);
        }

        $pengukuran->delete();

        return response()->json([
            'pesan' => 'Data pengukuran berhasil dihapus'
        ]);
    }
}
