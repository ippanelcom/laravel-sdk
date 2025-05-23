<?php

namespace Ippanel;

use Illuminate\Support\ServiceProvider;

class IppanelServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../config/ippanel.php' => config_path('ippanel.php'),
        ], 'config');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/ippanel.php', 'ippanel');

        $this->app->singleton(Client::class, function ($app) {
            $apiKey = config('ippanel.api_key');
            $baseUrl = config('ippanel.base_url');

            return new Client($apiKey, $baseUrl);
        });

        $this->app->alias(Client::class, 'ippanel');
    }
}

