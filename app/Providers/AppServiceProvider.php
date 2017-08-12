<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        $this->app->make('validator')->extend('slug', function($attribute, $value, $parameters, $validator) {

            $exists = $this->app->make('db')->table($parameters[0])->where($attribute, str_slug($value))->count();

            if ($exists > 0) {
                $validator->setCustomMessages(["The {$attribute} already exists"]);

                return false;
            }

            return true;
        });

        $this->app->make('validator')->extend('translatable_object', function(
            $attribute,
            $value,
            $parameters,
            $validator
        ) {

            if (! empty($parameters)) {
                $min = $parameters[0];
                $max = $parameters[1] ?? null;
            }

            if (is_string($value)) {
                $rule = '';
                $validator->setData([$attribute => $value]);

                if (! empty($min)) {
                    $rule = "min:{$min}";
                }

                if (! empty($max)) {
                    $rule .= "|max:{$max}";
                }

                $validator->setRules([
                    $attribute => $rule,
                ]);

                $validator->passes();

                return true;
            }

            foreach ($value as $key => $data) {
                if (! is_string($key) || strlen($data) == 0) {
                    $validator->setCustomMessages(["The {$attribute} is not a valid object"]);

                    return false;
                }

                if (! empty($min) && strlen($data) < $min) {
                    $validator->setCustomMessages(["The {$attribute} value should be at least {$min} characters"]);

                    return false;
                }

                if (! empty($max) && strlen($data) > $max) {
                    $validator->setCustomMessages(["The {$attribute} value may nit be greater than {$max} characters"]);

                    return false;
                }
            }

            return true;
        });
    }
}
