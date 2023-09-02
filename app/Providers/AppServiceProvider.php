<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
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

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('extractFirstName', function ($fullName) {
            return "<?php
            \$nameParts = explode(' ', $fullName);
            \$firstName = \$nameParts[0];
            echo \$firstName;
        ?>";
        });


    }
}
