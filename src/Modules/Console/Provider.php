<?php

namespace AvoRed\Framework\Modules\Console;

use Illuminate\Support\ServiceProvider;

class Provider extends ServiceProvider
{
    /**
     * Command Name for the AvoRed Console.
     *
     * @var array
     */
    protected $commandName = [
        'avored.module.install',
        'avored.module.make',
        'avored.controller.make',
    ];

    /**
     * Command Identifier for the AvoRed Console.
     *
     * @var array
     */
    protected $commands;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerCommands();
    }

    protected function registerCommands()
    {
        foreach ($this->commandName as $commandName) {
            $methodName = 'register'.implode(array_map('ucfirst', explode('.', $commandName)));
            $this->$methodName();

            $this->commands[] = 'command.'.$commandName;
        }

        $this->commands($this->commands);
    }

    /**
     * Register the Avored Module Make .
     *
     * @return void
     */
    protected function registerAvoredModuleMake()
    {
        $this->app->singleton('command.avored.module.make', function ($app) {
            return new ModuleMakeCommand($app['files']);
        });
    }

    /**
     * Register the Avored Module Install .
     *
     * @return void
     */
    protected function registerAvoredModuleInstall()
    {
        $this->app->singleton('command.avored.module.install', function ($app) {
            return new ModuleInstallCommand($app['migrator']);
        });
    }

    /**
     * Register Avored Module Controller Make Command.
     *
     * @return void
     */
    protected function registerAvoredControllerMake()
    {
        $this->app->singleton('command.avored.controller.make', function ($app) {
            return new ControllerMakeCommand($app['files']);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return $this->commands;
    }
}
