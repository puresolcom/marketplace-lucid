<?php

namespace App\Providers;

use Illuminate\Contracts\Validation\Validator;
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
        // create image
        $this->app->singleton('intervention', function () {
            return new ImageManager();
        });
    }

    public function boot()
    {
        $this->app->make('validator')->extend('slug', function ($attribute, $value, $parameters, $validator) {

            if (! preg_match('/^[a-z0-9-_]+$/', $value)) {
                $validator->setCustomMessages(["({$value}) is not a valid ({$attribute})"]);

                return false;
            }

            if (isset($parameters[1])) {
                $currentPk = $parameters[1];
            }

            $exists = $this->app->make('db')->table($parameters[0]);
            if (isset($currentPk)) {
                $exists->whereNotIn('id', [$currentPk]);
            }
            $exists->where($attribute, str_slug($value));

            if ($exists->count() > 0) {
                $validator->setCustomMessages(["The {$attribute} already exists"]);

                return false;
            }

            return true;
        });

        $this->app->make('validator')->extend('translatable_object', function (
            $attribute,
            $value,
            $parameters,
            $validator
        ) {
            $rule = [];
            if (! empty($parameters)) {
                $min     = $parameters[0];
                $max     = $parameters[1] ?? null;
                $rule [] = "min:{$min}";
                if (! empty($max)) {
                    $rule[] = "max:{$max}";
                }
            }

            if (is_string($value)) {

                $validator->setData(array_merge($validator->getData(), [$attribute => $value]));

                $validator->setRules(array_merge($validator->getRules(), [$attribute => $rule]));

                $validator->passes();

                return true;
            }

            foreach ($value as $key => $data) {
                if (! is_string($key)) {
                    $validator->setCustomMessages(["The {$attribute} is not a valid object"]);

                    return false;
                }

                if (! empty($min) && strlen($data) < $min) {
                    $validator->setCustomMessages(["The {$attribute} value should be at least {$min} characters"]);

                    return false;
                }

                if (! empty($max) && strlen($data) > $max) {
                    $validator->setCustomMessages(["The {$attribute} value may not be greater than {$max} characters"]);

                    return false;
                }
            }

            return true;
        });
    }
}
