<?php

<<<<<<< HEAD
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HistoriPrediksiController;
=======
>>>>>>> 325d7e65487e9e3d1b9d3c419cc1098add9cf8f4
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
<<<<<<< HEAD
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

    Route::resource('histori-prediksi', HistoriPrediksiController::class)->only([
        'index', 'destroy'
    ])->names([
        'index' => 'histori.index',
        'destroy' => 'histori.destroy',
    ]);
});
=======
    return response()->json(['pesan' => 'Selamat datang di API Prediksi Stunting']);
});
>>>>>>> 325d7e65487e9e3d1b9d3c419cc1098add9cf8f4
