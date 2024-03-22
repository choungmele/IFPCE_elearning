<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;


class ValidationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Validator::extend('date_equals_or_greater_than', function ($attribute, $value, $parameters, $validator) {
            $minDate = now()->addHours($parameters[0]);
            return now() >= $minDate;
        });
    }
}
