<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GuestPrediksiController extends Controller
{
    public function predict(Request $request)
    {
        $request->validate([
            'nama_anak' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'umur_bulan' => 'required|numeric|min:0|max:60',
            'berat_badan' => 'required|numeric|min:0',
            'tinggi_badan' => 'required|numeric|min:0',
        ]);

        $mlData = [
            'nama'          => $request->nama_anak,
            'jenis_kelamin' => $request->jenis_kelamin,
            'umur_bulan'    => (float)$request->umur_bulan,
            'berat_badan'   => (float)$request->berat_badan,
            'tinggi_badan'  => (float)$request->tinggi_badan,
        ];

        try {
            $apiUrl = env('ML_API_URL', 'http://127.0.0.1:8001') . '/predict';
            $response = Http::timeout(30)->post($apiUrl, $mlData);

            if ($response->failed()) {
                return response()->json([
                    'success' => false,
                    'pesan' => 'Gagal terhubung ke Server AI. Pastikan Server ML sudah dijalankan.',
                    'error' => $response->body()
                ], 503);
            }

            $result = $response->json();
            
            // Map the result for the frontend
            $prediksiML = $result['prediksi'];
            $zScores = $result['z_score_who'] ?? null;

            return response()->json([
                'success' => true,
                'data' => [
                    'nama' => $request->nama_anak,
                    'status' => [
                        'ha' => $prediksiML['stunting_ha']['keterangan'] ?? 'Unknown',
                        'wa' => $prediksiML['berat_badan_wa']['keterangan'] ?? 'Unknown',
                        'wh' => $prediksiML['gizi_wh']['keterangan'] ?? 'Unknown',
                        'hfa' => $prediksiML['height_for_age']['keterangan'] ?? 'Unknown',
                    ],
                    'z_score' => $zScores,
                    'probabilitas' => $prediksiML['stunting_ha']['probabilitas'] ?? 1.0,
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'pesan' => 'Terjadi kesalahan teknis saat menghubungi AI.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
