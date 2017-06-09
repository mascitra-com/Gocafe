<?php

namespace App\Providers;

use App\Info;
use Illuminate\Support\Facades\View;
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
        // TODO Fix This
        $info = Info::orderBy('part')->where('type', '1')->get();
        View::share('footer', $info);
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
