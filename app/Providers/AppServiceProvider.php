<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Intervention\Image\ImageManager;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function boot()
    {
        $this->app->make('validator')->extend('slug', function ($attribute, $value, $parameters, $validator) {

            $exists = $this->app->make('db')->table($parameters[0])->where($attribute, str_slug($value))->count();

            if ($exists > 0) {
                $validator->setCustomMessages(["The {$attribute} already exists"]);

                return false;
            }

            return true;
        });

        // create image
        $this->app->singleton('intervention', function () {
            return new ImageManager();
        });
    }
}
