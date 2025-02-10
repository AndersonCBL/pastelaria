<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

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
        $this->configureRoutes();
    }

    /**
     * Configure the routes for the application.
     *
     * @return void
     */
    protected function configureRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->app->getNamespace() . 'Http\Controllers')
            ->group(base_path('routes/api.php'));

        Route::middleware('web')
            ->namespace($this->app->getNamespace() . 'Http\Controllers')
            ->group(base_path('routes/web.php'));
    }
}
