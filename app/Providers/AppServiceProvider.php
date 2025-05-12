<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
        config(['app.timezone' => 'Asia/Kuala_Lumpur']);
        date_default_timezone_set('Asia/Kuala_Lumpur');
        app()->setLocale('id');
        Carbon::setLocale('id');

        Model::preventLazyLoading(! app()->isProduction());
        Schema::defaultStringLength(191);
        
    }
}
