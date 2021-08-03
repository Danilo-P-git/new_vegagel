<?php

namespace App\Providers;
use App\Observers\Order_ProductObserver;
use App\Observers\SectorObserver;
use App\Observers\ProductObserver;
use App\Order_Product;
use App\Product;
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
        Product::observe(ProductObserver::class);
        Sector::observe(SectorObserver::class);


        Order_Product::observe(Order_ProductObserver::class);
        
    }
}
