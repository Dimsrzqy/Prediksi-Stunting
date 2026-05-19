<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AdminPrediksiController extends Controller
{
    public function index()
    {
        return view('admin.menus.prediksi');
    }

    public function predict(Request $request)
    {
        // 1. Validasi data input yang dikirim dari form admin
        $request->validate([
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'umur_bulan' => 'required|numeric|min:0|max:60',
            'berat_badan' => 'required|numeric|min:0',
            'tinggi_badan' => 'required|numeric|min:0',
        ]);

        // 2. Siapkan payload parameter sesuai format yang diterima oleh ML FastAPI Server v3
        $mlData = [
            'jenis_kelamin'    => $request->jenis_kelamin,
            'umur_bulan'       => (int)$request->umur_bulan,
            'tinggi_badan_cm'  => (float)$request->tinggi_badan,
            'berat_badan_kg'   => (float)$request->berat_badan,
        ];

        try {
            // 3. Panggil API Model Machine Learning dari folder ML (FastAPI Server)
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
            
            // Mengambil hasil klasifikasi stunting dari model FastAPI
            $hasilPrediksi = $result['hasil_prediksi'] ?? 'Unknown';
            $labelAsli = $result['label_asli_sistem'] ?? $hasilPrediksi;

            return response()->json([
                'success' => true,
                'data' => [
                    'hasil_prediksi' => $hasilPrediksi,
                    'label_asli' => $labelAsli,
                    'input' => $mlData
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

