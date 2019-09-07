<?php

namespace AvoRed\Framework\Support\Providers;

use AvoRed\Framework\Modules\Manager;
use Illuminate\Support\ServiceProvider;
use AvoRed\Framework\Support\Facades\Module;

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
        $this->app->alias('module', 'AvoRed\Framework\Modules\Manager');
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
        $this->app->register('AvoRed\Framework\Modules\Console\Provider');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['module', 'AvoRed\Framework\Modules\Manager'];
    }
}
