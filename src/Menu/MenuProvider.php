<?php

namespace AvoRed\Framework\Menu;

use Illuminate\Support\ServiceProvider;

class MenuProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    public function boot()
    {
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerServices();
        $this->app->alias('menu', 'AvoRed\Framework\Menu\Builder');
    }

    /**
     * Register the Admin Menu instance.
     *
     * @return void
     */
    protected function registerServices()
    {
        $this->app->singleton('menu', function () {
            return new Builder();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['menu', 'AvoRed\Framework\Menu\Builder'];
    }
}
