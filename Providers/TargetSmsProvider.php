<?php

namespace agoalofalife\targetsms\Providers;

use agoalofalife\targetsms\Wrappers\WrapperBalance;
use agoalofalife\targetsms\Wrappers\WrapperGetSmsStatus;
use agoalofalife\targetsms\Wrappers\WrapperSendSms;
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
        $this->app->bind(WrapperSendSms::class, WrapperSendSms::class);
        $this->app->bind(WrapperGetSmsStatus::class, WrapperGetSmsStatus::class);
        $this->app->bind(WrapperBalance::class, WrapperBalance::class);
    }
}
