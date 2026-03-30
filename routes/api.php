<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AnakController;
use App\Http\Controllers\ProfilIbuController;
use App\Http\Controllers\PrediksiController;
use App\Http\Controllers\NutrisiController;
use App\Http\Controllers\RekomendasiNutrisiController;
use App\Http\Controllers\MakananController;

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
    Route::apiResource('prediksi', PrediksiController::class);
    Route::apiResource('nutrisi', NutrisiController::class);
    Route::apiResource('rekomendasi-nutrisi', RekomendasiNutrisiController::class);
    Route::apiResource('makanan', MakananController::class);

    // Bonus: Kita buatkan rute untuk Logout (Nanti kita buat fungsinya)
    // Route::post('/logout', [AuthController::class, 'logout']); 
});