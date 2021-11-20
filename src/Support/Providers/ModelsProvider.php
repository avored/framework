<?php

namespace AvoRed\Framework\Support\Providers;

use AvoRed\Framework\Database\Contracts\AddressModelInterface;
use AvoRed\Framework\Database\Contracts\AdminUserModelInterface;
use AvoRed\Framework\Database\Contracts\AttributeModelInterface;
use AvoRed\Framework\Database\Contracts\CategoryModelInterface;
use AvoRed\Framework\Database\Contracts\ConfigurationModelInterface;
use AvoRed\Framework\Database\Contracts\CustomerModelInterface;
use AvoRed\Framework\Database\Contracts\DocumentModelInterface;
use AvoRed\Framework\Database\Contracts\OrderModelInterface;
use AvoRed\Framework\Database\Contracts\OrderProductModelInterface;
use AvoRed\Framework\Database\Contracts\OrderStatusModelInterface;
use AvoRed\Framework\Database\Contracts\PageModelInterface;
use AvoRed\Framework\Database\Contracts\PermissionModelInterface;
use AvoRed\Framework\Database\Contracts\ProductModelInterface;
use AvoRed\Framework\Database\Contracts\PropertyModelInterface;
use AvoRed\Framework\Database\Contracts\RoleModelInterface;
use AvoRed\Framework\Database\Contracts\VisitorModelInterface;
use AvoRed\Framework\Database\Repository\AddressRepository;
use AvoRed\Framework\Database\Repository\AdminUserRepository;
use AvoRed\Framework\Database\Repository\AttributeRepository;
use AvoRed\Framework\Database\Repository\CategoryRepository;
use AvoRed\Framework\Database\Repository\ConfigurationRepository;
use AvoRed\Framework\Database\Repository\CustomerRepository;
use AvoRed\Framework\Database\Repository\DocumentRepository;
use AvoRed\Framework\Database\Repository\OrderProductRepository;
use AvoRed\Framework\Database\Repository\OrderRepository;
use AvoRed\Framework\Database\Repository\OrderStatusRepository;
use AvoRed\Framework\Database\Repository\PageRepository;
use AvoRed\Framework\Database\Repository\PermissionRepository;
use AvoRed\Framework\Database\Repository\ProductRepository;
use AvoRed\Framework\Database\Repository\PropertyRepository;
use AvoRed\Framework\Database\Repository\RoleRepository;
use AvoRed\Framework\Database\Repository\VisitorRepository;
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
        AddressModelInterface::class => AddressRepository::class,
        AdminUserModelInterface::class => AdminUserRepository::class,
        AttributeModelInterface::class => AttributeRepository::class,
        CategoryModelInterface::class => CategoryRepository::class,
        ConfigurationModelInterface::class => ConfigurationRepository::class,
        CustomerModelInterface::class => CustomerRepository::class,
        DocumentModelInterface::class => DocumentRepository::class,
        OrderModelInterface::class => OrderRepository::class,
        OrderProductModelInterface::class => OrderProductRepository::class,
        OrderStatusModelInterface::class => OrderStatusRepository::class,
        PageModelInterface::class => PageRepository::class,
        ProductModelInterface::class => ProductRepository::class,
        PropertyModelInterface::class => PropertyRepository::class,
        PermissionModelInterface::class => PermissionRepository::class,
        VisitorModelInterface::class => VisitorRepository::class,
        RoleModelInterface::class => RoleRepository::class,
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
