<?php
// tanaryo-cloud/shared/src/Providers/SharedServiceProvider.php
namespace TanaryoCloud\Shared\Providers;

use Illuminate\Support\ServiceProvider;
use TanaryoCloud\Shared\Services\JwtService;

class SharedServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(JwtService::class, function ($app) {
            return new JwtService(config('jwt.secret'));
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/jwt.php' => config_path('jwt.php'),
        ], 'tanaryo-cloud-config');
    }
}