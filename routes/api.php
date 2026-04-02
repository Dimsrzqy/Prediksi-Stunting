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

// ==========================================
// 🔓 AREA PUBLIK (Bebas Masuk Tanpa Token)
// ==========================================
Route::post('/register', [AuthController::class, 'registerApi']);
Route::post('/login', [AuthController::class, 'loginApi']);

// ==========================================
// 🔒 AREA VIP (Wajib Bawa Token Sanctum)
// ==========================================
Route::middleware('auth:sanctum')->group(function () {
    
    // Semua rute di dalam kotak ini sudah digembok!
    Route::apiResource('anak', AnakController::class);
    Route::apiResource('profil-ibu', ProfilIbuController::class);
    Route::apiResource('pengukuran', PengukuranController::class);
    Route::apiResource('prediksi', PrediksiController::class);
    Route::apiResource('nutrisi', NutrisiController::class);
    Route::apiResource('rekomendasi-nutrisi', RekomendasiNutrisiController::class);
    Route::apiResource('makanan', MakananController::class);

    // Endpoint khusus Profil Ibu
    Route::get('/profil', [\App\Http\Controllers\Api\ProfilUserController::class, 'show']);
    Route::put('/profil', [\App\Http\Controllers\Api\ProfilUserController::class, 'update']);

    // Bonus: Kita buatkan rute untuk Logout (Nanti kita buat fungsinya)
    // Route::post('/logout', [AuthController::class, 'logout']); 
});