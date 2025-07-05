<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if (env(key: 'APP_ENV') !== 'local') {
            URL::forceScheme(scheme: 'https');
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        if ($this->app->environment('local') && isset($_SERVER['HTTP_X_FORWARDED_HOST'])) {
            $host = $_SERVER['HTTP_X_FORWARDED_HOST'];
            $schema = $_SERVER['HTTP_X_FORWARDED_PROTO'] ?? 'https';
            URL::forceRootUrl("$schema://$host");

            // If you're using https
            if ($schema === 'https') {
                URL::forceScheme('https');
            }
        }
    }
}
