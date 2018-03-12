<?php
namespace AvoRed\Framework;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;

class Provider extends ServiceProvider
{

    protected $providers = [
        \AvoRed\Framework\AdminMenu\Provider::class,
        \AvoRed\Framework\Breadcrumb\Provider::class,
        \AvoRed\Framework\DataGrid\Provider::class,
        \AvoRed\Framework\Image\Provider::class,
        \AvoRed\Framework\Modules\Provider::class,
        \AvoRed\Framework\Payment\Provider::class,
        \AvoRed\Framework\Permission\Provider::class,
        \AvoRed\Framework\Shipping\Provider::class,
        \AvoRed\Framework\Tabs\Provider::class,
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

        $this->registerResources();
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


    /**
     * Register AvoRed Framework Resources here
     * @return void
     */

    public function registerResources() {

        $this->loadViewsFrom(__DIR__. "/../resources/views", "avored-framework");

    }
}