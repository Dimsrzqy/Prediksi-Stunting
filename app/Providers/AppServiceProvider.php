<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum; // <-- Tambahkan ini
use MongoDB\Laravel\Sanctum\PersonalAccessToken; // <-- Tambahkan ini

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Beri tahu Sanctum untuk pakai MongoDB saat bikin Token <-- Tambahkan ini
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
    }
}