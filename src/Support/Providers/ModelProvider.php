<?php

namespace AvoRed\Framework\Support\Providers;

use Illuminate\Support\ServiceProvider;
use AvoRed\Framework\Support\Facades\Module;
use AvoRed\Framework\Modules\Manager;
use AvoRed\Framework\Database\Contracts\RoleModelInterface;
use AvoRed\Framework\Database\Repository\RoleRepository;
use AvoRed\Framework\Database\Contracts\AdminUserModelInterface;
use AvoRed\Framework\Database\Repository\AdminUserRepository;
use AvoRed\Framework\Database\Contracts\LanguageModelInterface;
use AvoRed\Framework\Database\Repository\LanguageRepository;
use AvoRed\Framework\Database\Contracts\CategoryModelInterface;
use AvoRed\Framework\Database\Repository\CategoryRepository;
use AvoRed\Framework\Database\Contracts\PermissionModelInterface;
use AvoRed\Framework\Database\Repository\PermissionRepository;

class ModelProvider extends ServiceProvider
{
     /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;
    /**
     * Models Array list to bind with It's Contact
     * @var array $models
     */
    protected $models = [
        AdminUserModelInterface::class => AdminUserRepository::class,
        LanguageModelInterface::class => LanguageRepository::class,
        RoleModelInterface::class => RoleRepository::class,
        CategoryModelInterface::class => CategoryRepository::class,
        PermissionModelInterface::class => PermissionRepository::class,
    ];
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerModelContracts();
    }
    /**
     * Bind The Eloquent Model with their contract.
     *
     * @return void
     */
    protected function registerModelContracts()
    {
        foreach ($this->models as $interface => $repository) {
            $this->app->bind($interface, $repository);
        }
    }
}
