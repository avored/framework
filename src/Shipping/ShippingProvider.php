<?php

namespace AvoRed\Framework\Support\Providers;

use AvoRed\Framework\Shipping\Manager;
use Illuminate\Support\ServiceProvider;

class ShippingProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     * @var bool
     */
    protected $defer = true;

    public function boot()
    {
        //$this->registerShipping();
    }

    /**
     * Register the service provider.
     * @return void
     */
    public function register()
    {
        $this->registerManager();
        $this->app->singleton('shipping', 'AvoRed\Framework\Shipping\Manager');
    }

    /**
     * Register the shipping Manager Instance.
     * @return void
     */
    protected function registerManager()
    {
        $this->app->singleton(
            'shipping',
            function () {
                new Manager();
            }
        );
    }

    /**
     * Get the services provided by the provider.
     * @return array
     */
    public function provides()
    {
        return ['shipping', 'AvoRed\Framework\Shipping\Manager'];
    }
}
