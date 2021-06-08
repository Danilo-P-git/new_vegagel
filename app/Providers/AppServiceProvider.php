<?php

namespace App\Providers;
use App\Observers\Order_ProductObserver;
use App\Observers\SectorObserver;

use App\Order_Product;
use App\Sector;

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
        Sector::observe(SectorObserver::class);

        Order_Product::observe(Order_ProductObserver::class);
        
    }
}
