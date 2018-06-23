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
    public function test_admin_menu_builder_add()
    {
        $builder = new Builder();
        $builder->add('test', function($menu) {
            $menu->label('label');
        });
        $menu = $builder->get('test');
        $this->assertEquals('label', $menu->label());
    }

    /**
     * Test to check if Builder can set the AdminMenu Label
     *
     * @return void
     */
    public function test_admin_menu_builder_all()
    {
        $builder = new Builder();
        $builder->add('test1', function($menu) {
            $menu->label('label1');
        });
        
        $builder->add('test2', function($menu) {
            $menu->label('label2');
        });
        $menus = $builder->getMenuItems();
        $this->assertCount(2, $menus);
    }

    /**
     * Test to check if Builder can set the AdminMenu Label
     *
     * @return void
     */
    public function test_admin_menu_label()
    {
        $builder = new Builder();
        $builder->add('test', function($menu) {
            $menu->label('label1');
        });
        $menu = $builder->get('test');

        $this->assertEquals('label1', $menu->label());
    }

    /**
     * Test to check if Builder can set the AdminMenu Label
     *
     * @return void
     */
    public function test_admin_menu_icon()
    {
        $builder = new Builder();
        $builder->add('test', function($menu) {
            $menu->icon('icon');
        });
        $menu = $builder->get('test');

        $this->assertEquals('icon', $menu->icon());
    }

    /**
     * Test to check if Builder can set the AdminMenu Label
     *
     * @return void
     */
    public function test_admin_menu_submenu()
    {
        $builder = new Builder();
        $builder->add('test', function($menu) {
            $menu->subMenu('sub_menu_key', 'test_object');
        });
        $menu = $builder->get('test');

        
        $this->assertArrayHasKey('sub_menu_key', $menu->subMenu());
    }
}
