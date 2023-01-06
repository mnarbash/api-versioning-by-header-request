<?php

namespace Mnarbash\ApiVersioningByHeaderRequest;

use Illuminate\Support\ServiceProvider;

class ApiVerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        require_once __DIR__.'/Helper/helpers.php';

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/api-versioning.php' => config_path('api-versioning.php'),
            ], 'config');
        }

    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/api-versioning.php', 'api-versioning');
    }
}
