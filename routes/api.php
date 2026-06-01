<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AnakController;
use App\Http\Controllers\Api\ProfilIbuController;
use App\Http\Controllers\Api\PrediksiController;
use App\Http\Controllers\Api\NutrisiController;
use App\Http\Controllers\Api\RekomendasiNutrisiController;
use App\Http\Controllers\Api\MakananController;
use App\Http\Controllers\Api\PengukuranController;
use App\Http\Controllers\Api\HistoriPrediksiController;
use App\Http\Controllers\Api\ArtikelController;

// ==========================================
// 🔓 AREA PUBLIK (Bebas Masuk Tanpa Token)
// ==========================================
Route::post('/register', [AuthController::class, 'registerApi']);
Route::post('/login', [AuthController::class, 'loginApi']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);
Route::post('/inspirasi/sync', [ArtikelController::class, 'sync']); // Endpoint untuk Web Scraper Python

// ==========================================
// 🔒 AREA VIP (Wajib Bawa Token Sanctum)
// ==========================================
Route::middleware('auth:sanctum')->group(function () {
    
    // Endpoint Inspirasi Harian
    Route::get('/inspirasi', [ArtikelController::class, 'index']);
    
    // Semua rute di dalam kotak ini sudah digembok!
    Route::apiResource('anak', AnakController::class);
    // Rute Custom untuk Data Pelengkap Ibu
    Route::get('profil-ibu', [\App\Http\Controllers\Api\ProfilIbuController::class, 'index']);
    Route::post('profil-ibu', [\App\Http\Controllers\Api\ProfilIbuController::class, 'store']);
    Route::apiResource('pengukuran', PengukuranController::class);
    Route::apiResource('prediksi', PrediksiController::class);
    Route::apiResource('nutrisi', NutrisiController::class);
    Route::apiResource('rekomendasi-nutrisi', RekomendasiNutrisiController::class);
    Route::apiResource('makanan', MakananController::class);

    // API Endpoints untuk Riwayat Prediksi (Mobile App)
    // More specific route first (grafik) to avoid route conflict
    Route::get('/riwayat/grafik/{idAnak}', [HistoriPrediksiController::class, 'getGrafikByAnak']);
    Route::get('/riwayat/{idAnak}', [HistoriPrediksiController::class, 'getRiwayatByAnak']);

    // Endpoint khusus Profil Ibu
    Route::get('/profil', [\App\Http\Controllers\Api\ProfilUserController::class, 'show']);
    Route::put('/profil', [\App\Http\Controllers\Api\ProfilUserController::class, 'update']);
    
    // Endpoint Eksekusi AI (Prediksi Stunting)
    Route::post('/prediksi/hitung', [\App\Http\Controllers\Api\PrediksiController::class, 'predict']);
    
    // Endpoint Eksekusi AI (Chatbot Server-Side)
    Route::post('/chat', [\App\Http\Controllers\Api\ChatbotController::class, 'sendMessage']);

    // Logout: Cabut Token Sanctum dari Server
    Route::post('/logout', [AuthController::class, 'logoutApi']); 
});