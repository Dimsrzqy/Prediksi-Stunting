<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Prediksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoriPrediksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $histori = Prediksi::with('anak')->orderBy('created_at', 'desc')->get();
        } else {
            // Ambil ID anak yang dimiliki user
            $anakIds = \App\Models\Anak::where('user_id', Auth::id())->pluck('_id')->toArray();
            $histori = Prediksi::whereIn('id_anak', $anakIds)
                ->with('anak')
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('admin.menus.histori', compact('histori'));
    }

    /**
     * Export data to CSV (Excel compatible).
     */
    public function export()
    {
        if (Auth::user()->role === 'admin') {
            $histori = Prediksi::with('anak')->orderBy('created_at', 'desc')->get();
        } else {
            $anakIds = \App\Models\Anak::where('user_id', Auth::id())->pluck('_id')->toArray();
            $histori = Prediksi::whereIn('id_anak', $anakIds)
                ->with('anak')
                ->orderBy('created_at', 'desc')
                ->get();
        }

        $filename = "histori_prediksi_" . date('Y-m-d_H-i-s') . ".csv";
        $handle = fopen('php://output', 'w');
        
        // Add UTF-8 BOM for Excel compatibility
        fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF));
        
        // Header
        fputcsv($handle, ['Nama Anak', 'Hasil Prediksi', 'Probabilitas', 'Tanggal Prediksi', 'Rekomendasi AI']);

        foreach ($histori as $item) {
            fputcsv($handle, [
                $item->anak->nama_anak ?? 'Data Terhapus',
                $item->hasil_prediksi,
                number_format($item->probabilitas * 100, 2) . '%',
                \Carbon\Carbon::parse($item->tanggal_prediksi ?? $item->created_at)->format('Y-m-d H:i:s'),
                $item->rekomendasi_ai ?? '-'
            ]);
        }

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        fclose($handle);
        exit;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('histori.index')->with('error', 'Anda tidak memiliki akses untuk menghapus data.');
        }

        $prediksi = Prediksi::find($id);
        if ($prediksi) {
            $prediksi->delete();
        }

        return redirect()->route('histori.index')->with('success', 'Data histori prediksi berhasil dihapus.');
    }

    /**
     * Data json untuk keperluan Chart di Dashboard.
     */
    public function chartData(Request $request)
    {
        $filter = $request->query('filter', 'bulan'); // default 'bulan'

        // Tentukan rentang waktu sesuai filter
        if ($filter === 'minggu') {
            $startDate = \Carbon\Carbon::now()->subDays(6)->startOfDay();
        } else {
            $startDate = \Carbon\Carbon::now()->subMonths(11)->startOfMonth();
        }

        // Ambil data hanya dalam rentang waktu yang relevan, diurutkan dari terbaru
        if (Auth::user()->role === 'admin') {
            $histori = Prediksi::where('created_at', '>=', $startDate)
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $anakIds = \App\Models\Anak::where('user_id', Auth::id())->pluck('_id')->toArray();
            $histori = Prediksi::whereIn('id_anak', $anakIds)
                ->where('created_at', '>=', $startDate)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        $periods = [];
        if ($filter === 'minggu') {
            // Siapkan array untuk 7 hari terakhir
            for ($i = 6; $i >= 0; $i--) {
                $periods[\Carbon\Carbon::now()->subDays($i)->format('Y-m-d')] = [
                    'Normal' => 0,
                    'Tinggi' => 0,
                    'Stunting' => 0,
                    'Sangat Stunting' => 0,
                ];
            }
        } else {
            // Siapkan array bulan untuk 12 bulan terakhir
            for ($i = 11; $i >= 0; $i--) {
                $periods[\Carbon\Carbon::now()->subMonths($i)->format('Y-m')] = [
                    'Normal' => 0,
                    'Tinggi' => 0,
                    'Stunting' => 0,
                    'Sangat Stunting' => 0,
                ];
            }
        }

        foreach ($histori as $item) {
            try {
                // Gunakan created_at sebagai acuan waktu utama (data terbaru)
                $tanggal = $item->created_at ?? ($item->tanggal_prediksi ?? null);

                if (!$tanggal) continue;

                // Cek jika field MongoDB\BSON\UTCDateTime exist
                if ($tanggal instanceof \MongoDB\BSON\UTCDateTime) {
                    $tanggal = $tanggal->toDateTime();
                }

                $date = \Carbon\Carbon::parse($tanggal);
                $key = $filter === 'minggu' ? $date->format('Y-m-d') : $date->format('Y-m');

                if (isset($periods[$key])) {
                    $res = ucfirst(strtolower($item->hasil_prediksi));

                    // Map hasil ke kategori standar
                    if (str_contains(strtolower($res), 'sangat') || str_contains(strtolower($res), 'severely')) {
                        $res = 'Sangat Stunting';
                    } elseif (str_contains(strtolower($res), 'tinggi')) {
                        $res = 'Tinggi';
                    } elseif (str_contains(strtolower($res), 'stunt') || str_contains(strtolower($res), 'pendek')) {
                        $res = 'Stunting';
                    } else {
                        $res = 'Normal';
                    }

                    if (isset($periods[$key][$res])) {
                        $periods[$key][$res]++;
                    }
                }
            } catch (\Exception $e) {
                // Skip data yang tanggalnya tidak valid
            }
        }

        // Format output array
        $labels = [];
        $dataNormal = [];
        $dataTinggi = [];
        $dataStunting = [];
        $dataSangatStunting = [];

        foreach ($periods as $k => $v) {
            if ($filter === 'minggu') {
                $labels[] = \Carbon\Carbon::createFromFormat('Y-m-d', $k)->translatedFormat('d M');
            } else {
                $labels[] = \Carbon\Carbon::createFromFormat('Y-m', $k)->translatedFormat('M Y');
            }
            $dataNormal[] = $v['Normal'];
            $dataTinggi[] = $v['Tinggi'];
            $dataStunting[] = $v['Stunting'];
            $dataSangatStunting[] = $v['Sangat Stunting'];
        }

        return response()->json([
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Normal',
                    'data' => $dataNormal,
                    'borderColor' => '#10B981',
                    'backgroundColor' => 'rgba(16, 185, 129, 0.2)',
                    'fill' => true,
                    'tension' => 0.4
                ],
                [
                    'label' => 'Tinggi',
                    'data' => $dataTinggi,
                    'borderColor' => '#3B82F6',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.2)',
                    'fill' => true,
                    'tension' => 0.4
                ],
                [
                    'label' => 'Stunting',
                    'data' => $dataStunting,
                    'borderColor' => '#F59E0B',
                    'backgroundColor' => 'rgba(245, 158, 11, 0.2)',
                    'fill' => true,
                    'tension' => 0.4
                ],
                [
                    'label' => 'Sangat Stunting',
                    'data' => $dataSangatStunting,
                    'borderColor' => '#E11D48',
                    'backgroundColor' => 'rgba(225, 29, 72, 0.2)',
                    'fill' => true,
                    'tension' => 0.4
                ]
            ]
        ]);
    }

    /**
     * API Endpoint: Get prediction history for a specific child
     * Called by Mobile App: GET /api/riwayat/{idAnak}
     */
    public function getRiwayatByAnak($idAnak)
    {
        // Verify that the child belongs to the authenticated user
        $anak = \App\Models\Anak::where('_id', $idAnak)->where('user_id', Auth::id())->first();
        if (!$anak) {
            return response()->json([
                'status' => 'error',
                'pesan' => 'Anak tidak ditemukan atau tidak memiliki akses'
            ], 403);
        }

        // Get prediction history for this child
        $riwayat = Prediksi::where('id_anak', $idAnak)
            ->with('anak')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $riwayat
        ]);
    }

    /**
     * API Endpoint: Get chart data for a specific child
     * Called by Mobile App: GET /api/riwayat/grafik/{idAnak}
     */
    public function getGrafikByAnak($idAnak, Request $request)
    {
        // Verify that the child belongs to the authenticated user
        $anak = \App\Models\Anak::where('_id', $idAnak)->where('user_id', Auth::id())->first();
        if (!$anak) {
            return response()->json([
                'status' => 'error',
                'pesan' => 'Anak tidak ditemukan atau tidak memiliki akses'
            ], 403);
        }

        // Get measurement history for this specific child
        $pengukuran = \App\Models\Pengukuran::where('id_anak', $idAnak)
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function ($item) {
                return [
                    'tinggi' => $item->tinggi_badan ?? 0,
                    'umur_bulan' => $item->umur_bulan,
                    'tanggal_ukur' => $item->tanggal_ukur,
                ];
            });

        return response()->json([
            'status' => 'success',
            'data' => $pengukuran
        ]);
    }
}
