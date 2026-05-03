<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HistoriPrediksiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/set-language/{lang}', function ($lang) {
    if (in_array($lang, ['id', 'en'])) {
        session()->put('locale', $lang);
    }
    return redirect()->back();
})->name('set-language');

Route::get('forgot-password', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [\App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [\App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->name('password.update');

// Rute yang butuh Login
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');



    Route::get('/anak', function () {
        return view('admin.menus.anak');
    })->name('anak.index');

    Route::get('/ibu', function () {
        return view('admin.menus.ibu');
    })->name('ibu.index');

    Route::get('/makanan', function () {
        return view('admin.menus.makanan');
    })->name('makanan.index');

    Route::get('/users', function () {
        return view('admin.menus.user');
    })->name('user.index');

    Route::get('/profil', function () {
        return view('admin.menus.profil');
    })->name('profil.index');
    Route::post('/profil', [\App\Http\Controllers\Api\AdminUserController::class, 'updateProfile'])->name('profil.update');
    Route::post('/profil/avatar', [\App\Http\Controllers\Api\AdminUserController::class, 'updateAvatar'])->name('profil.avatar');

    Route::get('/pengaturan', function () {
        return view('admin.menus.pengaturan');
    })->name('pengaturan.index');

    // Rute API untuk dipanggil dari view web (menggunakan session auth bawaan web)
    Route::get('/api-anak/export', [\App\Http\Controllers\Api\AnakController::class, 'export'])->name('anak.export');
    Route::apiResource('api-anak', \App\Http\Controllers\Api\AnakController::class);
    Route::get('/api-ibu/export', [\App\Http\Controllers\Api\ProfilIbuController::class, 'export'])->name('ibu.export');
    Route::apiResource('api-ibu', \App\Http\Controllers\Api\ProfilIbuController::class);
    Route::apiResource('api-users', \App\Http\Controllers\Api\AdminUserController::class);
    Route::get('/api-chart-histori', [\App\Http\Controllers\Api\HistoriPrediksiController::class, 'chartData']);

    Route::get('/histori-prediksi/export', [\App\Http\Controllers\Api\HistoriPrediksiController::class, 'export'])->name('histori.export');

    Route::resource('histori-prediksi', \App\Http\Controllers\Api\HistoriPrediksiController::class)->only([
        'index',
        'destroy'
    ])->names([
        'index' => 'histori.index',
        'destroy' => 'histori.destroy',
    ]);
});
