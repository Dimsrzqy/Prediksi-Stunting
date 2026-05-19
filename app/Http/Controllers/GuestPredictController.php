<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class GuestPredictController extends Controller
{
    private $mlApiUrl = 'http://localhost:8001/predict';

    public function predict(Request $request)
    {
        $validated = $request->validate([
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'umur_bulan' => 'required|integer|min:0',
            'tinggi_badan_cm' => 'required|numeric|gt:0',
            'berat_badan_kg' => 'required|numeric|gt:0',
        ]);

        try {
            $client = new Client();
            
            $response = $client->post($this->mlApiUrl, [
                'json' => [
                    'jenis_kelamin' => $validated['jenis_kelamin'],
                    'umur_bulan' => (int)$validated['umur_bulan'],
                    'tinggi_badan_cm' => (float)$validated['tinggi_badan_cm'],
                    'berat_badan_kg' => (float)$validated['berat_badan_kg'],
                ],
                'timeout' => 10,
            ]);

            $mlResult = json_decode($response->getBody(), true);

            // Map hasil prediksi ke kategori
            $hasil = $mlResult['hasil_prediksi'] ?? 'Tidak Diketahui';
            $kategori = $this->mapKategori($hasil);

            return response()->json([
                'success' => true,
                'data' => [
                    'hasil_prediksi' => $hasil,
                    'kategori' => $kategori,
                    'label_asli' => $mlResult['label_asli_sistem'] ?? null,
                    'input_data' => $mlResult['data_dimasukkan'] ?? null,
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghubungi server prediksi: ' . $e->getMessage()
            ], 500);
        }
    }

    private function mapKategori($hasil)
    {
        $hasil = strtolower($hasil);
        
        if (strpos($hasil, 'normal') !== false || strpos($hasil, 'tinggi') !== false) {
            return [
                'status' => 'Risiko Rendah',
                'color' => 'emerald',
                'icon' => 'fa-check-circle',
                'recommendation' => 'Kondisi si kecil berada dalam kategori normal. Teruskan pemberian nutrisi seimbang dan pantau tumbuh kembang secara rutin.'
            ];
        } elseif (strpos($hasil, 'pendek') !== false) {
            return [
                'status' => 'Risiko Sedang',
                'color' => 'yellow',
                'icon' => 'fa-exclamation-circle',
                'recommendation' => 'Si kecil menunjukkan tanda risiko stunting. Segera konsultasikan dengan tenaga kesehatan atau posyandu terdekat untuk penanganan dini.'
            ];
        } elseif (strpos($hasil, 'sangat') !== false) {
            return [
                'status' => 'Risiko Tinggi',
                'color' => 'red',
                'icon' => 'fa-warning',
                'recommendation' => 'Ditemukan indikasi stunting yang signifikan. Sangat disarankan untuk segera melakukan pemeriksaan medis intensif ke dokter spesialis anak.'
            ];
        }

        return [
            'status' => 'Tidak Diketahui',
            'color' => 'gray',
            'icon' => 'fa-circle-question',
            'recommendation' => 'Hasil analisis tidak dapat ditentukan. Silakan coba lagi atau hubungi tim medis kami.'
        ];
    }
}
