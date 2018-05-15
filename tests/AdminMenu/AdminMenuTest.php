<?php

namespace AvoRed\Framework\Tests\AdminMenu;

use AvoRed\Framework\Tests\BaseTestCase;
use AvoRed\Framework\AdminMenu\Builder;

class AdminMenuTest extends BaseTestCase
{
    /**
     * Test to check if Builder can set the AdminMenu Key
     *
     * @return void
     */
    public function test_admin_menu_key()
    {
        $builder = new Builder();
        
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

        $this->assertEquals($menu->route(), 'admin.test.route.name');
    }

    /**
     * Test to check if Builder can set the AdminMenu Label
     *
     * @return void
     */
    public function test_admin_menu_icon()
    {
        $builder = new Builder();
        $menu = $builder->add('test')->icon('fa fa-book');

        $this->assertEquals($menu->icon(), 'fa fa-book');
    }

    /**
     * Test to check if Builder can set the AdminMenu Label
     *
     * @return void
     */
    public function test_admin_menu_submenu()
    {

        $builder = new Builder();
        $menu = $builder->add('test')->subMenu('test', 'MENUOBJECT');

        $subMenu = $menu->subMenu();
        $this->assertEquals($subMenu, ['test' => 'MENUOBJECT']);
    }
}


