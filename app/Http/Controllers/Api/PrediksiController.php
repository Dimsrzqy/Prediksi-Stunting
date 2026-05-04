<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Prediksi;
use App\Models\Anak;
use App\Models\Nutrisi;
use App\Models\Makanan;
use App\Models\RekomendasiNutrisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

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

        // 4. Siapkan Data untuk ML API (Python/FastAPI) - format sesuai predict_api.py v2
        $mlData = [
            'nama'          => $anak->nama_anak,
            'jenis_kelamin' => $anak->jenis_kelamin, // string: "Laki-laki" atau "Perempuan"
            'umur_bulan'    => (float)$request->umur_bulan,
            'berat_badan'   => (float)$request->berat_badan,
            'tinggi_badan'  => (float)$request->tinggi_badan,
        ];

        // 5. Panggil ML API menggunakan library HTTP Laravel
        try {
            $apiUrl = env('ML_API_URL', 'http://127.0.0.1:8001') . '/predict';
            $response = \Illuminate\Support\Facades\Http::timeout(30)->post($apiUrl, $mlData);

            if ($response->failed()) {
                return response()->json([
                    'pesan' => 'Gagal terhubung ke Server AI. Pastikan Server ML sudah dijalankan.',
                    'hint'  => 'Jalankan file run_ml_server.bat di folder Machine Learning SC',
                    'error' => $response->body()
                ], 503);
            }

            $result = $response->json();
            $prediksiML = $result['prediksi'];
            $zScores = $result['z_score_who'] ?? null;

            // Ambil keempat indikator
            $hasilHA = $prediksiML['stunting_ha']['keterangan'] ?? 'Unknown';
            $hasilWA = $prediksiML['berat_badan_wa']['keterangan'] ?? 'Unknown';
            $hasilWH = $prediksiML['gizi_wh']['keterangan'] ?? 'Unknown';
            $hasilHFA = $prediksiML['height_for_age']['keterangan'] ?? 'Unknown';
            
            // Probabilitas HA (untuk status utama)
            $probabilitasHA = $prediksiML['stunting_ha']['probabilitas'] ?? 1.0;

            // 7. Penentuan 3 Kategori Status berdasarkan Z-Score (Logika Python User)
            $statusHA = $this->mapStatusHA($z_ha);
            $statusWA = $this->mapStatusWA($z_wa);
            $statusWH = $this->mapStatusWH($z_wh);

            // 8. Dapatkan Rekomendasi Terstruktur (Cek DB dulu, baru Gemini)
            $rekomendasiData = $this->getStructuredRecommendation($statusHA, [
                'status_ha' => $statusHA,
                'status_wa' => $statusWA,
                'status_wh' => $statusWH,
                'umur' => $request->umur_bulan,
                'jk' => $anak->jenis_kelamin,
                'bb' => $request->berat_badan,
                'tb' => $request->tinggi_badan,
                'z_ha' => $z_ha,
                'z_wa' => $z_wa,
                'z_wh' => $z_wh
            ]);

            // 9. Simpan Hasil Prediksi ke Database
            $prediksi = Prediksi::create([
                'id_anak' => $request->id_anak,
                'hasil_prediksi' => $statusHA, // HA tetap sebagai hasil utama (Stunting)
                'hasil_wa' => $statusWA,
                'hasil_wh' => $statusWH,
                'hasil_hfa' => $hasilHFA,
                'probabilitas' => $probabilitasHA, 
                'z_scores' => $zScores,
                'tanggal_prediksi' => now()->toDateString(),
                'rekomendasi_ai' => $rekomendasiData['teks_rekomendasi'] ?? '',
                'rekomendasi_data' => $rekomendasiData['data_terstruktur'] ?? []
            ]);

            return response()->json([
                'pesan' => 'Prediksi berhasil dihitung!',
                'data' => [
                    'id_prediksi' => $prediksi->_id,
                    'anak' => $anak->nama_anak,
                    'status' => [
                        'ha' => $statusHA,
                        'wa' => $statusWA,
                        'wh' => $statusWH,
                        'hfa' => $hasilHFA
                    ],
                    'prediksi' => $prediksiML,
                    'z_score_who' => $zScores,
                    'rekomendasi_teks' => $prediksi->rekomendasi_ai,
                    'rekomendasi_terstruktur' => $prediksi->rekomendasi_data,
                ]
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'pesan' => 'Terjadi kesalahan teknis saat menghubungi AI.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    private function mapStatusHA($z)
    {
        if ($z >= -1.5) return 'Normal';
        if ($z > -2.0) return 'Berisiko';
        return 'Stunting';
    }

    private function mapStatusWA($z)
    {
        if ($z >= -2.0 && $z <= 1.0) return 'Normal';
        if ($z > 1.0) return 'Lebih';
        if ($z > -3.0) return 'Kurang';
        return 'Sangat Kurang';
    }

    private function mapStatusWH($z)
    {
        if ($z >= -2.0 && $z <= 1.0) return 'Normal';
        if ($z > 1.0 && $z <= 2.0) return 'Beresiko';
        if ($z > 2.0) return 'Obesitas';
        if ($z > -3.0) return 'Kurang';
        return 'Buruk';
    }

    private function getStructuredRecommendation($kategoriUtama, $dataLengkap)
    {
        // 1. Cek di Database dulu (berdasarkan status utama HA)
        $existingRecs = RekomendasiNutrisi::where('kategori_risiko', $kategoriUtama)
            ->with('nutrisi.makanan')
            ->get();

        if ($existingRecs->isNotEmpty()) {
            $dataTerstruktur = [];
            $teksArr = ["Berdasarkan database gizi kami, untuk kondisi anak Anda (Status H/A: $kategoriUtama), berikut saran nutrisinya:"];

            foreach ($existingRecs as $rec) {
                if ($rec->nutrisi) {
                    $makanans = $rec->nutrisi->makanan->pluck('nama_makanan')->toArray();
                    $dataTerstruktur[] = [
                        'nutrisi' => $rec->nutrisi->nama_nutrisi,
                        'makanan' => $rec->nutrisi->makanan
                    ];
                    $teksArr[] = "- " . ucwords($rec->nutrisi->nama_nutrisi) . ": " . implode(', ', $makanans);
                }
            }

            return [
                'data_terstruktur' => $dataTerstruktur,
                'teks_rekomendasi' => implode("\n", $teksArr)
            ];
        }

        // 2. Jika belum ada, Panggil Gemini untuk membuat data baru (JSON)
        return $this->generateGeminiStructured($kategoriUtama, $dataLengkap);
    }

    private function generateGeminiStructured($kategoriUtama, $data)
    {
        $apiKey = env('GEMINI_API_KEY');
        if (!$apiKey) return ['teks_rekomendasi' => 'API Key missing.', 'data_terstruktur' => []];

        $prompt = "Persona: Ahli Gizi Anak.\n"
            . "Input Kondisi Anak:\n"
            . "- Status H/A (Stunting): {$data['status_ha']} (Z: {$data['z_ha']})\n"
            . "- Status W/A (Berat/Umur): {$data['status_wa']} (Z: {$data['z_wa']})\n"
            . "- Status W/H (Gizi/Proporsi): {$data['status_wh']} (Z: {$data['z_wh']})\n"
            . "- Detail: Umur {$data['umur']} bln, JK: {$data['jk']}, BB: {$data['bb']}kg, TB: {$data['tb']}cm.\n\n"
            . "Tugas: Berikan 2-3 jenis Nutrisi utama yang paling dibutuhkan dan 3-5 contoh Makanan spesifik untuk memperbaiki kondisi tersebut.\n"
            . "Format WAJIB JSON: \n"
            . "{\n"
            . "  \"nutrisi_list\": [\n"
            . "    {\n"
            . "      \"nama_nutrisi\": \"Nama Nutrisi\",\n"
            . "      \"makanan_list\": [\n"
            . "        {\"nama\": \"Nama Makanan\", \"deskripsi\": \"Mengapa makanan ini baik untuk kondisi di atas?\"}\n"
            . "      ]\n"
            . "    }\n"
            . "  ],\n"
            . "  \"saran_teks\": \"Tulis 2-3 kalimat saran gizi holistik berdasarkan ketiga status di atas.\"\n"
            . "}\n"
            . "Hanya kirimkan JSON saja.";

        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key={$apiKey}";
        
        try {
            $response = Http::withoutVerifying()->post($url, [
                'contents' => [['parts' => [['text' => $prompt]]]]
            ]);
            
            if ($response->successful()) {
                $rawText = $response->json()['candidates'][0]['content']['parts'][0]['text'] ?? '';
                $jsonText = preg_replace('/```json|```/', '', $rawText);
                $aiData = json_decode($jsonText, true);

                if ($aiData && isset($aiData['nutrisi_list'])) {
                    $savedData = [];
                    foreach ($aiData['nutrisi_list'] as $n) {
                        // Simpan Nutrisi
                        $nutrisi = Nutrisi::firstOrCreate(['nama_nutrisi' => strtolower($n['nama_nutrisi'])]);
                        
                        // Link kategori utama ke nutrisi
                        RekomendasiNutrisi::firstOrCreate([
                            'kategori_risiko' => $kategoriUtama,
                            'id_nutrisi' => $nutrisi->id
                        ]);

                        $makananList = [];
                        foreach ($n['makanan_list'] as $m) {
                            // Simpan Makanan
                            $makanan = Makanan::firstOrCreate(
                                ['nama_makanan' => $m['nama']],
                                ['id_nutrisi' => $nutrisi->id, 'deskripsi' => $m['deskripsi']]
                            );
                            $makananList[] = $makanan;
                        }

                        $savedData[] = [
                            'nutrisi' => $nutrisi->nama_nutrisi,
                            'makanan' => $makananList
                        ];
                    }

                    return [
                        'data_terstruktur' => $savedData,
                        'teks_rekomendasi' => $aiData['saran_teks'] ?? 'Saran gizi telah diperbarui.'
                    ];
                }
            }
        } catch (\Exception $e) {
            Log::error('Gemini Structured Error: ' . $e->getMessage());
        }

        return ['teks_rekomendasi' => 'Sistem sedang menyiapkan saran gizi.', 'data_terstruktur' => []];
    }
}
