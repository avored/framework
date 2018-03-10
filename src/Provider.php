<?php
namespace AvoRed\Framework;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;

class Provider extends ServiceProvider
{

    protected $providers = [
        \AvoRed\Framework\Theme\Provider::class,
        \AvoRed\Framework\Widget\Provider::class
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerProviders();
    }


    /**
     * Registering AvoRed E commerce Services
     * e.g Admin Menu
     *
     * @return void
     */
    protected function registerProviders()
    {
        foreach ($this->providers as $provider) {
            App::register($provider);
        }
    }

}