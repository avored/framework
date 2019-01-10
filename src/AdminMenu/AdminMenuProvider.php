<?php

namespace AvoRed\Framework\AdminMenu;

use Illuminate\Support\ServiceProvider;
use AvoRed\Framework\AdminMenu\Facade as AdminMenuFacade;

class AdminMenuProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    public function boot()
    {
        $this->registerAdminMenu();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerServices();
        $this->app->alias('adminmenu', 'AvoRed\Framework\AdminMenu\Builder');
    }

    /**
     * Register the Admin Menu instance.
     *
     * @return void
     */
    protected function registerServices()
    {
        $this->app->singleton('adminmenu', function () {
            return new Builder();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['adminmenu', 'AvoRed\Framework\AdminMenu\Builder'];
    }

    /**
     * Register the Menus.
     *
     * @return void
     */
    protected function registerAdminMenu()
    {

        //trans('avored-framework::admin.menu.catalog')


        AdminMenuFacade::add('shop', function (AdminMenu $shopMenu) {
            $shopMenu->label( 'Catálogo')->route('#')->icon('ti-shopping-cart');
        });

        $shopMenu = AdminMenuFacade::get('shop');
        $shopMenu->subMenu('category', function (AdminMenu $menu) {
            $menu->key('category')->label('Categorias')->route('admin.category.index');
        });

        $shopMenu->subMenu('product', function (AdminMenu $menu) {
            $menu->key('category')->label('Produtos')->route('admin.product.index');
        });

        $shopMenu->subMenu('attribute', function (AdminMenu $menu) {
            $menu->key('attribute')->label('Produto - Atributos')->route('admin.attribute.index');
        });

        $shopMenu->subMenu('property', function (AdminMenu $menu) {
            $menu->key('property')->label('Produto - Propriedades')->route('admin.property.index');
        });

        AdminMenuFacade::add('content', function (AdminMenu $menu) {
            $menu->label('Conteúdo')->route('#')->icon('ti-files');
        });

        $contentMenu = AdminMenuFacade::get('content');
        $contentMenu->subMenu('page', function (AdminMenu $menu) {
            $menu->key('page')->label('Páginas')->route('admin.page.index');
        });

        $contentMenu->subMenu('menu', function (AdminMenu $menu) {
            $menu->key('menu')->label('Menu')->route('admin.menu.index');
        });

        AdminMenuFacade::add('user', function (AdminMenu $menu) {
            $menu->label('Clientes')->route('#')->icon('ti-user');
        });

        $userMenu = AdminMenuFacade::get('user');

        $userMenu->subMenu('user', function (AdminMenu $menu) {
            $menu->key('user')->label('Overview')->route('admin.user.index');
        });
        $userMenu->subMenu('user_group', function (AdminMenu $menu) {
            $menu->key('user_group')->label('Grupo de Clientes')->route('admin.user-group.index');
        });

        AdminMenuFacade::add('orders', function (AdminMenu $menu) {
            $menu->label('Compras')->route('#')->icon('ti-truck');
        });

        $orderMenu = AdminMenuFacade::get('orders');
        $orderMenu->subMenu('order', function (AdminMenu $menu) {
            $menu->key('order')->label('Visão Geral')->route('admin.order.index');
        });
        $orderMenu->subMenu('order_return_request', function (AdminMenu $menu) {
            $menu->key('order_return_request')
                ->label('Solicitações de devolução')
                ->route('admin.order-return-request.index');
        });

        $orderMenu->subMenu('order_status', function (AdminMenu $menu) {
            $menu->key('order')->label('Status de Pedido')->route('admin.order-status.index');
        });

        AdminMenuFacade::add('system', function (AdminMenu $systemMenu) {
            $systemMenu->label('Configuração')->route('#')->icon('ti-settings');
        });

        $systemMenu = AdminMenuFacade::get('system');

        $systemMenu->subMenu('configuration', function (AdminMenu $menu) {
            $menu->key('configuration')->label('Configuração')->route('admin.configuration')->icon('ti-settings');
        });

        $systemMenu->subMenu('site_currency_setup', function (AdminMenu $menu) {
            $menu->key('site_currency_setup')->label('Moedas')->route('admin.site-currency.index');
        });

        $systemMenu->subMenu('country', function (AdminMenu $menu) {
            $menu->key('country')->label('País')->route('admin.country.index');
        });

        $systemMenu->subMenu('state', function (AdminMenu $menu) {
            $menu->key('state')->label('Estado')->route('admin.state.index');
        });

        $systemMenu->subMenu('module', function (AdminMenu $menu) {
            $menu->key('module')->label('Módulos do Sistema')->route('admin.module.index');
        });

        $systemMenu->subMenu('admin-user', function (AdminMenu $menu) {
            $menu->key('admin-user')->label('Equipe')->route('admin.admin-user.index');
        });

        $systemMenu->subMenu('role', function (AdminMenu $menu) {
            $menu->key('role')->label('Grupos/Permissões')->route('admin.role.index');
        });

        $systemMenu->subMenu('themes', function (AdminMenu $menu) {
            $menu->key('themes')->label('Temas')->route('admin.theme.index');
        });
    }
}
