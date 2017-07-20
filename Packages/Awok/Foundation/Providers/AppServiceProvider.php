<?php

namespace Awok\Foundation\Providers;

use Awok\Foundation\Exceptions\Handler\JsonExceptionsHandler;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(
            ExceptionHandler::class,
            JsonExceptionsHandler::class
        );
    }
}
