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

    public function predict(Request $request)
    {
        $request->validate([
            'id_anak' => 'required',
            'tinggi_badan' => 'required|numeric',
            'berat_badan' => 'required|numeric',
            'umur_bulan' => 'required|numeric',
        ]);

        // 1. Ambil Data Anak & Validasi Kepemilikan
        $anak = Anak::where('_id', $request->id_anak)->where('user_id', Auth::id())->first();
        if (!$anak) {
            return response()->json(['pesan' => 'Anak tidak ditemukan atau akses dilarang!'], 403);
        }

        // 2. Simpan ke Riwayat Pengukuran (History)
        \App\Models\Pengukuran::create([
            'id_anak' => $request->id_anak,
            'umur_bulan' => $request->umur_bulan,
            'tinggi_badan' => $request->tinggi_badan,
            'berat_badan' => $request->berat_badan,
            'tanggal_ukur' => now()->toDateString(),
        ]);

        // 3. Update Data Terkini di tabel Anak
        $anak->update([
            'tinggi_badan' => $request->tinggi_badan,
            'berat_badan' => $request->berat_badan,
            'tgl_pemeriksaan' => now()->toDateString(),
        ]);

        // 4. Siapkan Data untuk ML API (Python/FastAPI)
        $mlData = [
            'nama' => $anak->nama_anak,
            'tinggi_badan' => (float)$request->tinggi_badan,
            'berat_badan' => (float)$request->berat_badan,
            'umur_bulan' => (float)$request->umur_bulan,
            'jenis_kelamin' => $anak->jenis_kelamin // misal: "Laki-laki" atau "Perempuan"
        ];

        // 5. Panggil ML API menggunakan library HTTP Laravel
        try {
            $apiUrl = env('ML_API_URL', 'http://127.0.0.1:8000') . '/predict';
            $response = \Illuminate\Support\Facades\Http::post($apiUrl, $mlData);

            if ($response->failed()) {
                return response()->json([
                    'pesan' => 'Gagal terhubung ke Server AI. Pastikan Server ML menyala.',
                    'error' => $response->body()
                ], 500);
            }

            $result = $response->json();
            $hasilPrediksi = $result['prediksi']['keterangan']; // "Normal", "Resiko Stunting", "Stunting"
            
            // 6. Simpan Hasil Prediksi ke Database
            $prediksi = Prediksi::create([
                'id_anak' => $request->id_anak,
                'hasil_prediksi' => $hasilPrediksi,
                'probabilitas' => 1.0, // Model Random Forest ini tidak mengembalikan probabilitas secara raw di API sederhana tadi
                'tanggal_prediksi' => now()->toDateString(),
            ]);

            return response()->json([
                'pesan' => 'Prediksi berhasil dihitung!',
                'data' => [
                    'anak' => $anak->nama_anak,
                    'hasil' => $hasilPrediksi,
                    'detail_ai' => $result['prediksi'],
                    'id_prediksi' => $prediksi->_id
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'pesan' => 'Terjadi kesalahan teknis saat menghubungi AI.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
