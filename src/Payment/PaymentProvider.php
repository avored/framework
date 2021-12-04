<?php

namespace AvoRed\Framework\Payment;

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
        $this->app->singleton('payment', PaymentManager::class);
    }

    /**
     * Get the services provided by the provider.
     * @return array
     */
    public function provides()
    {
        return ['payment', PaymentManager::class];
    }
}
