<?php

namespace AvoRed\Framework\Module;

use AvoRed\Framework\Module\Console\Provider;
use Illuminate\Support\ServiceProvider;

class ModuleProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    public function boot()
    {
        Module::all();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerModuleConsoleProvider();
        $this->registerModule();
        $this->app->alias('module', Manager::class);
    }

    /**
     * Register the AdmainConfiguration instance.
     *
     * @return void
     */
    protected function registerModule()
    {
        $this->app->singleton(
            'module',
            function ($app) {
                return new Manager($app['files']);
            }
        );
    }

    /*
     * Register Module console Command which Register most Module generation Command
     *
     * @return void
     */
    public function registerModuleConsoleProvider()
    {
        $this->app->register(Provider::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['module', Manager::class];
    }
}
