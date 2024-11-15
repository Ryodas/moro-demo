<?php

namespace TanaryoCloud\Shared\Providers;

use Illuminate\Support\ServiceProvider;
use TanaryoCloud\Shared\Services\JwtService;

class SharedServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(JwtService::class, function ($app) {
            return new JwtService(config('jwt.secret'));
        });
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/jwt.php' => config_path('jwt.php'),
        ], 'jwt-config');

        $this->app['config']->set('jwt.secret', env('JWT_SECRET'));
    }
}
