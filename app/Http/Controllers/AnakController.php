<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use Illuminate\Http\Request;

class AnakController extends Controller
{

    public function index()
    {
        $data = Anak::all();
        return response()->json([
            'pesan' => 'Berhasil mengambil data anak',
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required',
            'nama_anak' => 'required',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'nama_ortu' => 'required',
        ]);

        $anak = Anak::create($request->all());

        return response()->json([
            'pesan' => 'Mantap! Data anak berhasil disimpan',
            'data' => $anak
        ], 201);
    }

    public function show($id)
    {
        $anak = Anak::find($id);
        
        if (!$anak) {
            return response()->json(['pesan' => 'Waduh, data anak tidak ditemukan!'], 404);
        }

        return response()->json([
            'pesan' => 'Detail data anak',
            'data' => $anak
        ]);
    }

    // Fungsi untuk MENGUPDATE data anak
    public function update(Request $request, $id)
    {
        $anak = Anak::find($id);
        
        if (!$anak) {
            return response()->json(['pesan' => 'Data anak tidak ditemukan!'], 404);
        }

        // Update data dengan isian baru dari Flutter
        $anak->update($request->all());

        return response()->json([
            'pesan' => 'Sip! Data anak berhasil diperbarui',
            'data' => $anak
        ]);
    }

    // Fungsi untuk MENGHAPUS data anak
    public function destroy($id)
    {
        $anak = Anak::find($id);
        
        if (!$anak) {
            return response()->json(['pesan' => 'Data anak tidak ditemukan!'], 404);
        }

        $anak->delete();

        return response()->json([
            'pesan' => 'Data anak berhasil dihapus dari sistem'
        ]);
    }
}