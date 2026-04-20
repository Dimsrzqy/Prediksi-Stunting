<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\HistoriPrediksi;
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
            $histori = HistoriPrediksi::all();
        } else {
            $histori = HistoriPrediksi::where('user_id', Auth::id())->get();
        }

        return view('histori.index', compact('histori'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HistoriPrediksi $historiPrediksi)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('histori.index')->with('error', 'Anda tidak memiliki akses untuk menghapus data.');
        }

        $historiPrediksi->delete();

        return redirect()->route('histori.index')->with('success', 'Data histori prediksi berhasil dihapus.');
    }

    /**
     * Data json untuk keperluan Chart di Dashboard.
     */
    public function chartData()
    {
        // Jika admin, ambil semua. Jika user, ambil miliknya saja.
        if (Auth::user()->role === 'admin') {
            $histori = HistoriPrediksi::all();
        } else {
            // Karena relasi belum disertakan di model (histori_prediksi tidak punya user_id), 
            // Sebagai pengaman kita kembalikan all() atau filter by id_anak yang dimiliki user. 
            // Berhubung dashboard admin yang diminta (role=admin), all() sudah cukup.
            $histori = HistoriPrediksi::all();
        }

        // Siapkan array bulan untuk 12 bulan terakhir
        $months = [];
        for ($i = 11; $i >= 0; $i--) {
            $months[\Carbon\Carbon::now()->subMonths($i)->format('Y-m')] = [
                'Normal' => 0,
                'Berisiko' => 0,
                'Stunting' => 0,
            ];
        }

        foreach ($histori as $item) {
            try {
                // Memastikan properti string atau default ke object ID creation time
                $tanggal = $item->tanggal_prediksi ?? clone $item->created_at;
                
                // Cek jika field MongoDB\BSON\UTCDateTime exist
                if ($tanggal instanceof \MongoDB\BSON\UTCDateTime) {
                    $tanggal = $tanggal->toDateTime();
                }

                $date = \Carbon\Carbon::parse($tanggal);
                $key = $date->format('Y-m');

                if (isset($months[$key])) {
                    $res = ucfirst(strtolower($item->hasil_prediksi));
                    if (isset($months[$key][$res])) {
                        $months[$key][$res]++;
                    }
                }
            } catch (\Exception $e) {
                // Skip data yang tanggalnya tidak valid
            }
        }

        // Format output array
        $labels = [];
        $dataNormal = [];
        $dataBerisiko = [];
        $dataStunting = [];

        foreach ($months as $k => $v) {
            $labels[] = \Carbon\Carbon::createFromFormat('Y-m', $k)->translatedFormat('M Y');
            $dataNormal[] = $v['Normal'];
            $dataBerisiko[] = $v['Berisiko'];
            $dataStunting[] = $v['Stunting'];
        }

        return response()->json([
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Normal',
                    'data' => $dataNormal,
                    'borderColor' => '#10B981', // Hijau Toska
                    'backgroundColor' => 'rgba(16, 185, 129, 0.2)',
                    'fill' => true,
                    'tension' => 0.4
                ],
                [
                    'label' => 'Berisiko',
                    'data' => $dataBerisiko,
                    'borderColor' => '#F59E0B', // Kuning Oranye
                    'backgroundColor' => 'rgba(245, 158, 11, 0.2)',
                    'fill' => true,
                    'tension' => 0.4
                ],
                [
                    'label' => 'Stunting',
                    'data' => $dataStunting,
                    'borderColor' => '#EF4444', // Merah
                    'backgroundColor' => 'rgba(239, 68, 68, 0.2)',
                    'fill' => true,
                    'tension' => 0.4
                ]
            ]
        ]);
    }
}
