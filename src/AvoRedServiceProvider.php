<?php

namespace AvoRed\Framework;

use AvoRed\Framework\Support\Providers\ModelsProvider;
use AvoRed\Framework\System\Console\AdminMakeCommand;
use AvoRed\Framework\System\Console\InstallCommand;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class AvoRedServiceProvider extends ServiceProvider
{
    protected $providers = [
        ModelsProvider::class,
    ];

    public function register()
    {
        $this->registerProviders();
        $this->registerConfig();
        $this->registerConsoleCommands();
    }

    public function boot()
    {
        $this->registerRoutes();
        $this->registerMigrationPath();
    }

    public function registerProviders()
    {
        foreach ($this->providers as $provider) {
            App::register($provider);
        }
    }

    public function registerRoutes()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
    }

    public function registerConfig()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/avored.php', 'avored');
    }

    public function registerConsoleCommands()
    {
        $this->commands([InstallCommand::class]);
        $this->commands([AdminMakeCommand::class]);
    }

    public function registerMigrationPath()
    {
        $this->loadMigrationsFrom(__DIR__. '/../database/migrations');
    }
}
