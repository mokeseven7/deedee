<?php

namespace App\Providers;

use App\SharedIsolation;

use Illuminate\Support\ServiceProvider;

class SharedIsolationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SharedIsolation::class, fn ($app) => new SharedIsolation($app));
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        
        app(\App\SharedIsolation::class)->start();

        // If we were running octane, It would have to be something like this instead
        //Event::listen(fn (OctaneRequestReceived $requestReceived) => app(SharedIsolation::class)->start());
    }
}
