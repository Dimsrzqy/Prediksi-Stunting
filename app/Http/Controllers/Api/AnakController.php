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

    public function export()
    {
        $user = Auth::user();

        // Otorisasi: Admin melihat semua data, User biasa melihat data anaknya saja
        if ($user && $user->role === 'admin') {
            $anak = Anak::with('ibu')->get();
        } else {
            // Ambil data ibu milik user ini
            $ibuIds = \App\Models\ProfilIbu::where('user_id', $user->id)->pluck('_id')->toArray();
            $anak = Anak::whereIn('id_ibu', $ibuIds)->with('ibu')->get();
        }

        $fileName = 'Data_Anak_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        // Daftar header kolom untuk file CSV/Excel
        $columns = ['No', 'NIK', 'Nama Anak', 'Nama Ibu', 'Tanggal Lahir', 'Jenis Kelamin', 'BB Lahir (kg)', 'TB Lahir (cm)', 'Pemeriksaan Terakhir (BB kg)', 'Pemeriksaan Terakhir (TB cm)'];

        $callback = function () use ($anak, $columns) {
            $file = fopen('php://output', 'w');

            // Tambahkan BOM agar karakter terbaca dengan baik di Microsoft Excel
            fputs($file, $bom = (chr(0xEF) . chr(0xBB) . chr(0xBF)));

            fputcsv($file, $columns);

            $rowIdx = 1;
            foreach ($anak as $data) {
                $namaIbu = $data->ibu ? $data->ibu->nama_ibu : ($data->nama_ortu ?? 'Tidak Diketahui');
                $jenisKelamin = $data->jenis_kelamin === 'L' ? 'Laki-laki' : ($data->jenis_kelamin === 'P' ? 'Perempuan' : $data->jenis_kelamin);

                fputcsv($file, [
                    $rowIdx++,
                    "'" . $data->nik, // Tambahkan tanda kutip agar NIK tidak berubah jadi format scientific (E+) di Excel
                    $data->nama_anak,
                    $namaIbu,
                    $data->tgl_lahir,
                    $jenisKelamin,
                    $data->bb_lahir ?? '-',
                    $data->tb_lahir ?? '-',
                    $data->berat_badan ?? '-',
                    $data->tinggi_badan ?? '-'
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
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
