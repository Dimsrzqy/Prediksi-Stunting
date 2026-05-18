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
        $request->validate([
            'umur_bulan' => 'required|numeric',
            'tinggi_badan' => 'required|numeric',
            'berat_badan' => 'required|numeric',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        ]);

        $mlData = [
            'jenis_kelamin'    => $request->jenis_kelamin,
            'umur_bulan'       => (int)$request->umur_bulan,
            'tinggi_badan_cm'  => (float)$request->tinggi_badan,
            'berat_badan_kg'   => (float)$request->berat_badan,
        ];

        try {
            $apiUrl = env('ML_API_URL', 'http://127.0.0.1:8001') . '/predict';
            $response = Http::timeout(30)->post($apiUrl, $mlData);

            if ($response->failed()) {
                return back()->with('error', 'Gagal terhubung ke Server AI. Pastikan Server ML (Python) sudah dijalankan pada port 8001.')->withInput();
            }

            $result = $response->json();

            // Sesuai ML v3: { hasil_prediksi: "...", label_asli_sistem: "..." }
            $hasilPrediksi = $result['hasil_prediksi'] ?? 'Unknown';
            $labelSistem = $result['label_asli_sistem'] ?? $hasilPrediksi;
            
            // Format warna berdasarkan status (mengikuti standar web)
            $statusClass = 'bg-gray-100 text-gray-800';
            $icon = 'fa-circle-question';
            $lowerHasil = strtolower($hasilPrediksi);

            if (str_contains($lowerHasil, 'normal')) {
                $statusClass = 'bg-emerald-100 text-emerald-800 border-emerald-200';
                $icon = 'fa-check-circle';
            } elseif (str_contains($lowerHasil, 'sangat pendek') || str_contains($lowerHasil, 'severely stunted')) {
                $statusClass = 'bg-red-100 text-red-800 border-red-200';
                $icon = 'fa-triangle-exclamation';
            } elseif (str_contains($lowerHasil, 'pendek') || str_contains($lowerHasil, 'stunted')) {
                $statusClass = 'bg-orange-100 text-orange-800 border-orange-200';
                $icon = 'fa-circle-exclamation';
            } elseif (str_contains($lowerHasil, 'tinggi')) {
                $statusClass = 'bg-blue-100 text-blue-800 border-blue-200';
                $icon = 'fa-arrow-up-right-dots';
            }

            return view('admin.menus.prediksi', [
                'result' => true,
                'hasil_prediksi' => $hasilPrediksi,
                'label_sistem' => $labelSistem,
                'status_class' => $statusClass,
                'icon' => $icon,
                'input' => $mlData
            ]);

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan teknis saat menghubungi AI: ' . $e->getMessage())->withInput();
        }
    }
}
