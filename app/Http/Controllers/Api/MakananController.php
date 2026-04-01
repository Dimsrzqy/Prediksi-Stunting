<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Makanan;
use Illuminate\Http\Request;

class MakananController extends Controller
{
    public function index()
    {
        $data = Makanan::with('nutrisi')->get();
        return response()->json([
            'pesan' => 'Berhasil mengambil data makanan',
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_makanan' => 'required|string',
            'id_nutrisi' => 'required',
            'deskripsi' => 'nullable|string',
        ]);

        $makanan = Makanan::create($request->all());

        return response()->json([
            'pesan' => 'Data makanan berhasil disimpan',
            'data' => $makanan
        ], 201);
    }

    public function show($id)
    {
        $makanan = Makanan::with('nutrisi')->find($id);

        if (!$makanan) {
            return response()->json(['pesan' => 'Data makanan tidak ditemukan!'], 404);
        }

        return response()->json([
            'pesan' => 'Detail data makanan',
            'data' => $makanan
        ]);
    }

    public function update(Request $request, $id)
    {
        $makanan = Makanan::find($id);

        if (!$makanan) {
            return response()->json(['pesan' => 'Data makanan tidak ditemukan!'], 404);
        }

        $request->validate([
            'nama_makanan' => 'sometimes|required|string',
            'id_nutrisi' => 'sometimes|required',
            'deskripsi' => 'nullable|string',
        ]);

        $makanan->update($request->all());

        return response()->json([
            'pesan' => 'Data makanan berhasil diperbarui',
            'data' => $makanan
        ]);
    }

    public function destroy($id)
    {
        $makanan = Makanan::find($id);

        if (!$makanan) {
            return response()->json(['pesan' => 'Data makanan tidak ditemukan!'], 404);
        }

        $makanan->delete();

        return response()->json([
            'pesan' => 'Data makanan berhasil dihapus'
        ]);
    }
}
