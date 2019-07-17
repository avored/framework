<?php

namespace AvoRed\Framework\Support\Providers;

use Illuminate\Support\ServiceProvider;
use AvoRed\Framework\Support\Facades\Module;
use AvoRed\Framework\Modules\Manager;
use AvoRed\Framework\Database\Contracts\RoleModelInterface;
use AvoRed\Framework\Database\Repository\RoleRepository;
use AvoRed\Framework\Database\Contracts\AttributeProductValueModelInterface;
use AvoRed\Framework\Database\Repository\AttributeProductValueRepository;
use AvoRed\Framework\Database\Contracts\AdminUserModelInterface;
use AvoRed\Framework\Database\Repository\AdminUserRepository;
use AvoRed\Framework\Database\Contracts\LanguageModelInterface;
use AvoRed\Framework\Database\Repository\LanguageRepository;
use AvoRed\Framework\Database\Contracts\CategoryModelInterface;
use AvoRed\Framework\Database\Repository\CategoryRepository;
use AvoRed\Framework\Database\Contracts\CategoryFilterModelInterface;
use AvoRed\Framework\Database\Repository\CategoryFilterRepository;
use AvoRed\Framework\Database\Contracts\PermissionModelInterface;
use AvoRed\Framework\Database\Repository\PermissionRepository;
use AvoRed\Framework\Database\Contracts\PageModelInterface;
use AvoRed\Framework\Database\Repository\PageRepository;
use AvoRed\Framework\Database\Contracts\MenuModelInterface;
use AvoRed\Framework\Database\Repository\MenuRepository;
use AvoRed\Framework\Database\Contracts\ConfigurationModelInterface;
use AvoRed\Framework\Database\Repository\ConfigurationRepository;
use AvoRed\Framework\Database\Contracts\OrderStatusModelInterface;
use AvoRed\Framework\Database\Repository\OrderStatusRepository;
use AvoRed\Framework\Database\Contracts\StateModelInterface;
use AvoRed\Framework\Database\Repository\StateRepository;
use AvoRed\Framework\Database\Contracts\CountryModelInterface;
use AvoRed\Framework\Database\Repository\CountryRepository;
use AvoRed\Framework\Database\Contracts\CurrencyModelInterface;
use AvoRed\Framework\Database\Repository\CurrencyRepository;
use AvoRed\Framework\Database\Contracts\PropertyModelInterface;
use AvoRed\Framework\Database\Repository\PropertyRepository;
use AvoRed\Framework\Database\Contracts\AttributeModelInterface;
use AvoRed\Framework\Database\Repository\AttributeRepository;
use AvoRed\Framework\Database\Contracts\ProductModelInterface;
use AvoRed\Framework\Database\Repository\ProductRepository;
use AvoRed\Framework\Database\Contracts\UserGroupModelInterface;
use AvoRed\Framework\Database\Repository\UserGroupRepository;
use AvoRed\Framework\Database\Contracts\TaxGroupModelInterface;
use AvoRed\Framework\Database\Repository\TaxGroupRepository;
use AvoRed\Framework\Database\Contracts\TaxRateModelInterface;
use AvoRed\Framework\Database\Repository\TaxRateRepository;
use AvoRed\Framework\Database\Contracts\AddressModelInterface;
use AvoRed\Framework\Database\Repository\AddressRepository;
use AvoRed\Framework\Database\Contracts\OrderModelInterface;
use AvoRed\Framework\Database\Repository\OrderRepository;
use AvoRed\Framework\Database\Contracts\ProductImageModelInterface;
use AvoRed\Framework\Database\Repository\ProductImageRepository;
use AvoRed\Framework\Database\Contracts\AttributeDropdownOptionModelInterface;
use AvoRed\Framework\Database\Repository\AttributeDropdownOptionRepository;
use AvoRed\Framework\Database\Contracts\ProductVariationModelInterface;
use AvoRed\Framework\Database\Repository\ProductVariationRepository;
use AvoRed\Framework\Database\Contracts\OrderProductModelInterface;
use AvoRed\Framework\Database\Repository\OrderProductRepository;
use AvoRed\Framework\Database\Contracts\OrderProductAttributeModelInterface;
use AvoRed\Framework\Database\Repository\OrderProductAttributeRepository;

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
        AddressModelInterface::class => AddressRepository::class,
        AdminUserModelInterface::class => AdminUserRepository::class,
        AttributeModelInterface::class => AttributeRepository::class,
        AttributeDropdownOptionModelInterface::class => AttributeDropdownOptionRepository::class,
        AttributeProductValueModelInterface::class => AttributeProductValueRepository::class,
        CategoryModelInterface::class => CategoryRepository::class,
        CategoryFilterModelInterface::class => CategoryFilterRepository::class,
        ConfigurationModelInterface::class => ConfigurationRepository::class,
        CountryModelInterface::class => CountryRepository::class,
        CurrencyModelInterface::class => CurrencyRepository::class,
        LanguageModelInterface::class => LanguageRepository::class,
        OrderModelInterface::class => OrderRepository::class,
        OrderProductModelInterface::class => OrderProductRepository::class,
        OrderProductAttributeModelInterface::class => OrderProductAttributeRepository::class,
        OrderStatusModelInterface::class => OrderStatusRepository::class,
        PermissionModelInterface::class => PermissionRepository::class,
        PageModelInterface::class => PageRepository::class,
        ProductModelInterface::class => ProductRepository::class,
        ProductVariationModelInterface::class => ProductVariationRepository::class,
        ProductImageModelInterface::class => ProductImageRepository::class,
        MenuModelInterface::class => MenuRepository::class,
        PropertyModelInterface::class => PropertyRepository::class,
        RoleModelInterface::class => RoleRepository::class,
        StateModelInterface::class => StateRepository::class,
        UserGroupModelInterface::class => UserGroupRepository::class,
        TaxGroupModelInterface::class => TaxGroupRepository::class,
        TaxRateModelInterface::class => TaxRateRepository::class,
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
