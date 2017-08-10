<?php

namespace App\Domains\Option;

use Illuminate\Support\ServiceProvider;

class OptionServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('option', function ($app) {
            return new OptionManager($app);
        });
    }
}