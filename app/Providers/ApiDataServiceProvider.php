<?php

namespace App\Providers;

use App\Services\ApiDataProvider;
use Illuminate\Support\ServiceProvider;

class ApiDataServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ApiDataProvider::class, function ($app) {
            return new ApiDataProvider();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

}
