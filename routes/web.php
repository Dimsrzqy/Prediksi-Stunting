<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HistoriPrediksiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/register', [AuthController::class, 'create'])->name('register');
Route::post('/register', [AuthController::class, 'store']);
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('forgot-password', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [\App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [\App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->name('password.update');

// Rute yang butuh Login
Route::middleware('auth')->group(function () {
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/makanan', function () {
        return view('admin.menus.makanan');
    })->name('makanan.index');

    Route::get('/anak', function () {
        return view('admin.menus.anak');
    })->name('anak.index');

    Route::get('/ibu', function () {
        return view('admin.menus.ibu');
    })->name('ibu.index');

    // Rute API untuk dipanggil dari view web (menggunakan session auth bawaan web)
    Route::apiResource('api-anak', \App\Http\Controllers\Api\AnakController::class);
    Route::apiResource('api-nutrisi', \App\Http\Controllers\Api\NutrisiController::class);
    Route::apiResource('api-makanan', \App\Http\Controllers\Api\MakananController::class);
    Route::apiResource('api-ibu', \App\Http\Controllers\Api\ProfilIbuController::class);


    Route::resource('histori-prediksi', HistoriPrediksiController::class)->only([
        'index', 'destroy'
    ])->names([
        'index' => 'histori.index',
        'destroy' => 'histori.destroy',
    ]);
});