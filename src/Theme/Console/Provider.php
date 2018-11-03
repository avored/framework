<?php

namespace AvoRed\Framework\Theme\Console;

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
        $this->registerMakeTheme();
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerMakeTheme()
    {
        $this->app->singleton('command.avored.theme.make', function ($app) {
            return new ThemeMakeCommand($app['files']);
        });

        $this->commands(['command.avored.theme.make']);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['command.avored.theme.make'];
    }
}
