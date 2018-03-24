<?php

namespace AvoRed\Framework\Modules;

use Illuminate\Support\ServiceProvider;
use AvoRed\Framework\Modules\Facade as Module;

class Provider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

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

        $modules = Module::all();
    }

    /**
     * Register the AdmainConfiguration instance.
     *
     * @return void
     */
    protected function registerModule()
    {
        $this->app->singleton('module', function ($app) {
            return new Manager($app['files']);
        });
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
