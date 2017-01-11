<?php

namespace agoalofalife\targetsms\Providers;

use Illuminate\Support\ServiceProvider;

class TargetSmsProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/targetSMS.php' => config_path('targetSMS.php')
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
