<?php

namespace App\Providers;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\ServiceProvider;

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
        //
    }
    public function map()
    {
        $this->mapApiRoutes(); // APIルートを読み込む
    }

    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->group(base_path('routes/api.php')); // api.php を読み込む
    }
}
