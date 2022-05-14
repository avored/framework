<?php

namespace AvoRed\Framework;

use AvoRed\Framework\System\Console\InstallCommand;
use Illuminate\Support\ServiceProvider;

class AvoRedServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerConfig();
        $this->registerConsoleCommands();
    }

    public function boot()
    {
        $this->registerRoutes();
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
        // $this->commands([AdminMakeCommand::class]);
    }
}
