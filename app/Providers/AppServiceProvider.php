<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;
use App\Models\MongoToken; 

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Beri tahu Sanctum untuk pakai Token punya kita
        Sanctum::usePersonalAccessTokenModel(MongoToken::class);
    }
}