<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Nutrisi;
use Illuminate\Http\Request;

class NutrisiController extends Controller
{
    public function index()
    {
        $data = Nutrisi::all();
        return response()->json([
            'pesan' => 'Berhasil mengambil data nutrisi',
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_nutrisi' => 'required|string',
        ]);

        $nutrisi = Nutrisi::create($request->all());

        return response()->json([
            'pesan' => 'Data nutrisi berhasil disimpan',
            'data' => $nutrisi
        ], 201);
    }

    public function show($id)
    {
        $nutrisi = Nutrisi::find($id);
        
        if (!$nutrisi) {
            return response()->json(['pesan' => 'Data nutrisi tidak ditemukan!'], 404);
        }

        return response()->json([
            'pesan' => 'Detail data nutrisi',
            'data' => $nutrisi
        ]);
    }

    public function update(Request $request, $id)
    {
        $nutrisi = Nutrisi::find($id);
        
        if (!$nutrisi) {
            return response()->json(['pesan' => 'Data nutrisi tidak ditemukan!'], 404);
        }

        $request->validate([
            'nama_nutrisi' => 'sometimes|required|string',
        ]);

        $nutrisi->update($request->all());

        return response()->json([
            'pesan' => 'Data nutrisi berhasil diperbarui',
            'data' => $nutrisi
        ]);
    }

    public function destroy($id)
    {
        $nutrisi = Nutrisi::find($id);
        
        if (!$nutrisi) {
            return response()->json(['pesan' => 'Data nutrisi tidak ditemukan!'], 404);
        }

        $nutrisi->delete();

        return response()->json([
            'pesan' => 'Data nutrisi berhasil dihapus'
        ]);
    }
}
