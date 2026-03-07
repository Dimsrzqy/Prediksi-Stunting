<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnakController;

Route::apiResource('anak', AnakController::class);

Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);

Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
