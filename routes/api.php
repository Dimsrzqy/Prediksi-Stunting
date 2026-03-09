<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AnakController;
use App\Http\Controllers\PengukuranController;

// ==========================================
// 🔓 AREA PUBLIK (Bebas Masuk Tanpa Token)
// ==========================================
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// ==========================================
// 🔒 AREA VIP (Wajib Bawa Token Sanctum)
// ==========================================
Route::middleware('auth:sanctum')->group(function () {
    
    // Semua rute di dalam kotak ini sudah digembok!
    Route::apiResource('anak', AnakController::class);
    Route::apiResource('pengukuran', PengukuranController::class);

    // Bonus: Kita buatkan rute untuk Logout (Nanti kita buat fungsinya)
    // Route::post('/logout', [AuthController::class, 'logout']); 
});