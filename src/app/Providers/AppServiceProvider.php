<?php

namespace App\Providers;

use App\Application\Interfaces\ILivroModel;
use App\Application\Models\FakeLivroModel;
use App\Application\Models\LivroModel;
use Illuminate\Support\Facades\Vite;
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
        Vite::prefetch(concurrency: 3);
    
        if (app()->environment('testing')) {
            $this->app->bind(ILivroModel::class, LivroModel::class);
        } else {
            $this->app->bind(ILivroModel::class, LivroModel::class);
        }

    }
}
