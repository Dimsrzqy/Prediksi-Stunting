<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ArtikelInspirasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ArtikelController extends Controller
{
    /**
     * Mengambil daftar artikel inspirasi terbaru untuk aplikasi Flutter
     * GET /api/inspirasi
     */
    public function index(Request $request)
    {
        try {
            // Mulai merakit query untuk mengambil data dari yang paling baru
            $query = ArtikelInspirasi::orderBy('tanggal_publikasi', 'desc')
                        ->orderBy('created_at', 'desc');

            // Jika Flutter meminta batasan jumlah data (limit)
            if ($request->has('limit')) {
                $query->limit((int) $request->query('limit'));
            }

            // Eksekusi query (ambil semua jika tidak ada limit, ambil sebagian jika ada limit)
            $artikel = $query->get();

            return response()->json([
                'status' => 'success',
                'data' => $artikel
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching inspirasi: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'pesan' => 'Gagal mengambil data inspirasi.'
            ], 500);
        }
    }

    /**
     * Menerima payload dari Python Web Scraper
     * POST /api/inspirasi/sync
     */
    public function sync(Request $request)
    {
        // Token sederhana untuk keamanan. Di production sebaiknya gunakan API Key auth.
        $token = $request->header('X-Scraper-Token');
        $expectedToken = env('SCRAPER_SECRET_TOKEN', 'stuntcheck_scraper_123');

        if ($token !== $expectedToken) {
            return response()->json(['status' => 'error', 'pesan' => 'Unauthorized'], 401);
        }

        $request->validate([
            'data' => 'required|array',
            'data.*.judul' => 'required|string',
            'data.*.deskripsi_singkat' => 'nullable|string',
            'data.*.kategori' => 'nullable|string',
        ]);

        $inserted = 0;

        foreach ($request->data as $item) {
            // Gunakan updateOrCreate untuk menghindari duplikasi berdasarkan judul
            ArtikelInspirasi::updateOrCreate(
                ['judul' => $item['judul']],
                [
                    'deskripsi_singkat' => $item['deskripsi_singkat'] ?? '',
                    'konten_lengkap' => $item['konten_lengkap'] ?? '',
                    'kategori' => $item['kategori'] ?? 'Umum',
                    'url_gambar' => $item['url_gambar'] ?? '',
                    'url_sumber' => $item['url_sumber'] ?? '',
                    'tanggal_publikasi' => isset($item['tanggal_publikasi']) 
                                            ? \Carbon\Carbon::parse($item['tanggal_publikasi']) 
                                            : now(),
                ]
            );
            $inserted++;
        }

        return response()->json([
            'status' => 'success',
            'pesan' => "$inserted artikel berhasil disinkronisasi."
        ]);
    }
}