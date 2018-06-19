<?php

namespace BlackBits\LaravelFirewall;

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class LaravelFirewallServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/firewall.php' => config_path('firewall.php'),
            ], 'config');

            $this->publishes([
                __DIR__.'/views' => resource_path('views/vendor/firewall'),
            ]);
        }

        $this->loadViewsFrom(__DIR__.'/views', 'firewall');
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/firewall.php', 'firewall');

        // register middleware in $routeMiddleware
        Route::aliasMiddleware('firewall', LaravelFirewall::class);

        resolve(Kernel::class)->pushMiddleware(LaravelFirewall::class);
    }
}
