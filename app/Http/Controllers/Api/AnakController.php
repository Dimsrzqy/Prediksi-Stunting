<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Anak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AnakController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $data = Anak::where('user_id', $user->id)->with('ibu')->get();

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
            'id_ibu' => 'required',
        ]);

        $input = $request->all();
        $input['user_id'] = Auth::id(); // Wajib ditambahkan agar terhubung dengan relasi User

        $anak = Anak::create($input);

        return response()->json([
            'pesan' => 'Mantap! Data anak berhasil disimpan',
            'data' => $anak
        ], 201);
    }

    public function show($id)
    {
        $anak = Anak::with('ibu')->find($id);
        
        if (!$anak) {
            return response()->json(['pesan' => 'data anak tidak ditemukan!'], 404);
        }

        return response()->json([
            'pesan' => 'Detail data anak',
            'data' => $anak
        ]); 
    }

    public function update(Request $request, $id)
    {
        $anak = Anak::find($id);
        
        if (!$anak) {
            return response()->json(['pesan' => 'Data anak tidak ditemukan!'], 404);
        }

        $anak->update($request->all());

        return response()->json([
            'pesan' => 'Data anak berhasil diperbarui',
            'data' => $anak
        ]);
    }

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