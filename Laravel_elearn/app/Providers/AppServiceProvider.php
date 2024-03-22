<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Validator::extend('date_equals_or_greater_than', function ($attribute, $value, $parameters, $validator) {
            // Vérifier si le tableau $parameters est défini et a au moins deux éléments
            if (isset($parameters[0], $parameters[1])) {
                $start = Carbon::createFromFormat('Y-m-d H:i:s', $validator->getData()[$parameters[0]]);
                $end = Carbon::createFromFormat('Y-m-d H:i:s', $value);
                $minDuration = $parameters[1]; // Pas besoin de ?? ici car on sait qu'il y a au moins deux éléments

                return $start->diffInHours($end) >= $minDuration;
            }

            // Si les paramètres ne sont pas correctement définis, la validation échoue
            return false;
        });
    }
}
