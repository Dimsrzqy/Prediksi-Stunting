<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProfilIbu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfilIbuController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user && $user->role === 'admin') {
            $profilIbu = ProfilIbu::with('anak')->get();
        } else {
            $profilIbu = ProfilIbu::where('user_id', $user->id)->with('anak')->get();
        }
        // Konsisten dengan controller lain: gunakan wrapper 'pesan' dan 'data'
        return response()->json([
            'pesan' => 'Berhasil mengambil data profil ibu',
            'data'  => $profilIbu
        ]);
    }

    public function export()
    {
        $user = Auth::user();

        // Otorisasi pengambilan data (sama seperti fungsi index)
        if ($user && $user->role === 'admin') {
            $profilIbu = ProfilIbu::with('anak')->get();
        } else {
            $profilIbu = ProfilIbu::where('user_id', $user->id)->with('anak')->get();
        }

        $fileName = 'Data_Profil_Ibu_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        // Daftar header kolom untuk file Excel
        $columns = ['No', 'Nama Ibu', 'Usia (Tahun)', 'Tinggi (cm)', 'Pendidikan', 'Pekerjaan', 'Jumlah Anak Terdaftar'];

        $callback = function () use ($profilIbu, $columns) {
            $file = fopen('php://output', 'w');

            // Tambahkan BOM agar karakter khusus terbaca dengan baik di Microsoft Excel
            fputs($file, $bom = (chr(0xEF) . chr(0xBB) . chr(0xBF)));

            fputcsv($file, $columns);

            $rowIdx = 1;
            foreach ($profilIbu as $ibu) {
                // Hitung jumlah anak dari relasi 'anak'
                $jumlahAnak = $ibu->anak ? $ibu->anak->count() : 0;

                fputcsv($file, [
                    $rowIdx++,
                    $ibu->nama_ibu,
                    $ibu->usia_ibu,
                    $ibu->tinggi_ibu,
                    $ibu->pendidikan_ibu,
                    $ibu->pekerjaan_ibu,
                    $jumlahAnak
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_ibu' => 'nullable|string', // Nullable agar Flutter tidak ditolak
            'usia_ibu' => 'required|integer|min:15',
            'tinggi_ibu' => 'required|numeric|min:100',
            'pendidikan_ibu' => 'required|string|max:255',
            'pekerjaan_ibu' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = Auth::user();
        $data = $request->all();
        $data['user_id'] = $user->id;

        // -----------------------------------------------------
        // Fallback: Jika 'nama_ibu' tidak disubmit dari Flutter, salin paksa nama User (Akun Utama)
        // -----------------------------------------------------
        if (!isset($data['nama_ibu']) || empty($data['nama_ibu'])) {
            $data['nama_ibu'] = $user->name;
        }

        $profilIbu = ProfilIbu::create($data);

        return response()->json($profilIbu, 201);
    }

    public function show($id)
    {
        $profilIbu = ProfilIbu::find($id);

        if (!$profilIbu) {
            return response()->json(['message' => 'Profil tidak ditemukan.'], 404);
        }

        // Otorisasi: Pastikan user hanya bisa melihat profil miliknya, KECUALI Admin
        if (Auth::user()->role !== 'admin' && $profilIbu->user_id !== Auth::id()) {
            return response()->json(['message' => 'Akses ditolak.'], 403);
        }

        $profilIbu->load('anak');
        return response()->json($profilIbu);
    }

    public function update(Request $request, $id)
    {
        $profilIbu = ProfilIbu::find($id);

        if (!$profilIbu) {
            return response()->json(['message' => 'Profil tidak ditemukan.'], 404);
        }

        if (Auth::user()->role !== 'admin' && $profilIbu->user_id !== Auth::id()) {
            return response()->json(['message' => 'Akses ditolak.'], 403);
        }

        $validator = Validator::make($request->all(), [
            'nama_ibu' => 'sometimes|nullable|string',
            'usia_ibu' => 'sometimes|required|integer|min:15',
            'tinggi_ibu' => 'sometimes|required|numeric|min:100',
            'pendidikan_ibu' => 'sometimes|required|string|max:255',
            'pekerjaan_ibu' => 'sometimes|required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $dataToUpdate = $request->except('user_id');
        $profilIbu->update($dataToUpdate);

        return response()->json($profilIbu);
    }

    public function destroy($id)
    {
        $profilIbu = ProfilIbu::find($id);

        if (!$profilIbu) {
            return response()->json(['message' => 'Profil tidak ditemukan.'], 404);
        }

        if (Auth::user()->role !== 'admin' && $profilIbu->user_id !== Auth::id()) {
            return response()->json(['message' => 'Akses ditolak.'], 403);
        }

        $profilIbu->delete();

        return response()->json(null, 204);
    }
}
