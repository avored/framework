<?php

namespace AvoRed\Framework\Support\Providers;

use AvoRed\Framework\Database\Contracts\AdminUserModelInterface;
use AvoRed\Framework\Database\Contracts\RoleModelInterface;
use AvoRed\Framework\Database\Repository\AdminUserRepository;
use AvoRed\Framework\Database\Repository\RoleRepository;
use Illuminate\Support\ServiceProvider;

class ModelsProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;
    /**
     * Models Array list to bind with It's Contact.
     * @var array
     */
    protected $models = [
        AdminUserModelInterface::class => AdminUserRepository::class,
        RoleModelInterface::class => RoleRepository::class,
    ];

    public function register()
    {
        $this->registerModelContracts();
    }

    protected function registerModelContracts()
    {
        foreach ($this->models as $interface => $repository) {
            $this->app->bind($interface, $repository);
        }
    }
}
