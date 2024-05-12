<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use PHPShopify\ShopifySDK;
use App\Config\Shopify; 

class ShopifyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ShopifySDK::class, function ($app) {
            $config = $app->make(Shopify::class);
            ShopifySDK::config($config->toArray());
            return new ShopifySDK;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}