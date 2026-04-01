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
}
