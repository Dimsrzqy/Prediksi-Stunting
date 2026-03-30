<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json(['pesan' => 'Selamat datang di API Prediksi Stunting']);
});