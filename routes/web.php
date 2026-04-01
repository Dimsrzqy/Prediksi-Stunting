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

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/menus', function () {
        return view('admin.menus.index');
    })->name('menus.index');

    Route::resource('histori-prediksi', HistoriPrediksiController::class)->only([
        'index', 'destroy'
    ])->names([
        'index' => 'histori.index',
        'destroy' => 'histori.destroy',
    ]);
});
