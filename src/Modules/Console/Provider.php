<?php

namespace AvoRed\Framework\Modules\Console;

use Illuminate\Support\ServiceProvider;

class Provider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerMakeModule();
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerMakeModule()
    {
        $this->app->singleton('command.avored.module.make', function ($app) {
            return new ModuleMakeCommand($app['files']);
        });
        $this->app->singleton('command.avored.controller.make', function ($app) {
            return new ControllerMakeCommand($app['files']);
        });

        $this->commands(['command.avored.module.make', 'command.avored.controller.make']);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['command.avored.module.make', 'command.avored.controller.make'];
    }
}
