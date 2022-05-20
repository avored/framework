<?php

namespace AvoRed\Framework\Document;

use Illuminate\Support\ServiceProvider;

class DocumentProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     * @var bool
     */
    protected $defer = true;

    /**
     * Boot the service provider.
     * @return void
     */
    public function boot()
    {
        $this->registerDocument();
    }

    /**
     * Register the service provider.
     * @return void
     */
    public function register()
    {
        $this->registerServices();
        $this->app->alias('document', 'AvoRed\Framework\Document\Manager');
    }

    /**
     * Register the Admin Menu instance.
     *
     * @return void
     */
    protected function registerServices()
    {
        $this->app->singleton(
            'document',
            function () {
                return new Manager();
            }
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['document', 'AvoRed\Framework\Document\Builder'];
    }

    /**
     * Register the Menus.
     *
     * @return void
     */
    protected function registerDocument()
    {
    }
}
