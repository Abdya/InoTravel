<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('countReq', function ($expression) {

            return  "<?php \$requestCount = \App\Booking::whereHas('property', function (\$query) {
                \$query->where('ownerId', \Auth::user()->id);
            })->where('status', 1)->count(); echo (\$requestCount > 0) ? '<span class=\"badge badge-danger\">'.\$requestCount.'</span>':'' ; ?>";
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
