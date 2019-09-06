<?php

namespace AvoRed\Framework\Support\Providers;

use AvoRed\Framework\Payment\Manager;
use Illuminate\Support\ServiceProvider;

class PaymentProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     * @var bool
     */
    protected $defer = true;

    public function boot()
    {
        //$this->registerPayment();
    }

    /**
     * Register the service provider.
     * @return void
     */
    public function register()
    {
        $this->registerManager();
        $this->app->singleton('payment', 'AvoRed\Framework\Payment\Manager');
    }

    /**
     * Register the payment Manager Instance.
     * @return void
     */
    protected function registerManager()
    {
        $this->app->singleton(
            'payment',
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
        return ['payment', 'AvoRed\Framework\Payment\Manager'];
    }
}
