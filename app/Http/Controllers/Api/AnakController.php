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
        // Bypass untuk admin agar semua data puskesmas terlihat
        if (Auth::user()->role === 'admin') {
            $data = Anak::with('ibu')->get();
        } else {
            // Hanya tampilkan data anak milik user yang sedang login
            $data = Anak::with('ibu')->where('user_id', Auth::id())->get();
        }

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
            'id_ibu' => 'nullable',
            'bb_lahir' => 'nullable|numeric',
            'tb_lahir' => 'nullable|numeric',
            'berat_badan' => 'nullable|numeric',
            'tinggi_badan' => 'nullable|numeric',
            'tgl_pemeriksaan' => 'nullable|date',
        ]);

        $input = $request->all();
        $input['user_id'] = Auth::id(); // Mengunci anak ini kepada Ibu/Kader yang login
        
        // Link otomatis ke profil ibu jika frontend tidak mengirim id_ibu
        if (empty($input['id_ibu'])) {
            $profilIbu = \App\Models\ProfilIbu::where('user_id', Auth::id())->first();
            if ($profilIbu) {
                $input['id_ibu'] = $profilIbu->_id ?? $profilIbu->id;
            }
        }

        $anak = Anak::create($input);
        $anak->load('ibu');

        return response()->json([
            'pesan' => 'Data anak berhasil disimpan',
            'data' => $anak
        ], 201);
    }

    public function show($id)
    {
        if (Auth::user()->role === 'admin') {
            $anak = Anak::where('_id', $id)->first();
        } else {
            $anak = Anak::where('_id', $id)->where('user_id', Auth::id())->first();
        }

        if (!$anak) {
            return response()->json(['pesan' => 'Data anak tidak ditemukan atau Anda tidak memiliki akses!'], 403);
        }

        return response()->json([
            'pesan' => 'Detail data anak',
            'data' => $anak
        ]);
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->role === 'admin') {
            $anak = Anak::where('_id', $id)->first();
        } else {
            $anak = Anak::where('_id', $id)->where('user_id', Auth::id())->first();
        }

        if (!$anak) {
            return response()->json(['pesan' => 'Data anak tidak ditemukan atau Anda tidak memiliki akses!'], 403);
        }

        $request->validate([
            'nik' => 'nullable',
            'nama_anak' => 'nullable',
            'tgl_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable',
            'nama_ortu' => 'nullable',
            'bb_lahir' => 'nullable|numeric',
            'tb_lahir' => 'nullable|numeric',
            'berat_badan' => 'nullable|numeric',
            'tinggi_badan' => 'nullable|numeric',
            'tgl_pemeriksaan' => 'nullable|date',
        ]);

        $anak->update($request->all());

        return response()->json([
            'pesan' => 'Data anak berhasil diperbarui',
            'data' => $anak
        ]);
    }

    public function destroy($id)
    {
        if (Auth::user()->role === 'admin') {
            $anak = Anak::where('_id', $id)->first();
        } else {
            $anak = Anak::where('_id', $id)->where('user_id', Auth::id())->first();
        }

        if (!$anak) {
            return response()->json(['pesan' => 'Data anak tidak ditemukan atau Anda tidak memiliki akses!'], 403);
        }

        $anak->delete();

        return response()->json([
            'pesan' => 'Data anak berhasil dihapus dari sistem'
        ]);
    }
}
