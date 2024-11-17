<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

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
    public function boot(): void
    {
        Validator::extend('unique_custom', function ($attribute, $value, $parameters) {
            // Get the parameters passed to the rule
            [$table, $field, $field2, $field2Value] = $parameters;

            // Check the table and return true only if there are no entries matching
            // both the first field name and the user input value as well as
            // the second field name and the second field value
            return DB::table($table)
                ->where($field, $value)
                ->where($field2, $field2Value)
                ->count() === 0;
        });
    }
}
