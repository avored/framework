<?php

namespace AvoRed\Framework\Tests\AdminMenu;

use AvoRed\Framework\AdminMenu\AdminMenu;
use PHPUnit\Framework\TestCase;
use AvoRed\Framework\AdminMenu\Builder;
use Mockery;

class AdminMenuTest extends TestCase
{
    /**
     * Test to check if Builder can set the AdminMenu Key
     *
     * @return void
     */
    public function test_admin_menu_key()
    {
        $builder = new Builder();

        $adminMenu = Mockery::mock(AdminMenu::class);
        $adminMenu->shouldReceive('key')->with('test')->andReturnSelf();

        $this->assertEquals($builder->add('test')->key(), 'test');
    }

    /**
     * Test to check if Builder can set the AdminMenu Label
     *
     * @return void
     */
    public function test_admin_menu_label()
    {
        $builder = new Builder();
        $menu = $builder->add('test')->label('Test Menu Label');

        $adminMenu = Mockery::mock(AdminMenu::class);
        $adminMenu->shouldReceive('label')->with('Test Menu Label')->andReturnSelf();

        $this->assertEquals($menu->label(), 'Test Menu Label');
    }

    /**
     * Test to check if Builder can set the AdminMenu Label
     *
     * @return void
     */
    public function test_admin_menu_route()
    {
        $builder = new Builder();
        $menu = $builder->add('test')->route('admin.test.route.name');

        $adminMenu = Mockery::mock(AdminMenu::class);
        $adminMenu->shouldReceive('route')->with('admin.test.route.name')->andReturnSelf();

        $this->assertEquals($menu->route(), 'admin.test.route.name');
    }
}


