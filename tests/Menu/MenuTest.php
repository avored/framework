<?php

namespace AvoRed\Framework\Tests\Menu;

use AvoRed\Framework\Tests\BaseTestCase;
use AvoRed\Framework\Menu\Builder;

class MenuTest extends BaseTestCase
{
   
    /** @test */
    public function test_menu_builder_make()
    {
        $manager = new Builder();

        $menu1 = $manager->make('test_menu_1', function () {
            return 'unittest1';
        });
        $menu2 = $manager->make('test_menu_2', function () {
            return 'unittest2';
        });

        $this->assertCount(2, $manager->all());
    }

    /**
     * Test to check if Menu class label
     *
     */
    public function test_menu_label()
    {
        $manager = new Builder();

        $manager->make('test_menu_1', function ($menu) {
            $menu->label('test');
        });
        $menu1 = $manager->get('test_menu_1');
        $this->assertEquals('test', $menu1->label());
    }

    /**
     * Test to check if Menu class key
     *
     */
    public function test_menu_key()
    {
        $manager = new Builder();

        $manager->make('test_menu_1', function ($menu) {
            return 'test';
        });
        $menu1 = $manager->get('test_menu_1');
        $this->assertEquals('test_menu_1', $menu1->key());
    }

    /**
     * Test to check if Menu class route
     *
     */
    public function test_menu_route()
    {
        $manager = new Builder();

        $manager->make('test_menu_1', function ($menu) {
            $menu->route('test.route');
        });
        $menu1 = $manager->get('test_menu_1');
        $this->assertEquals('test.route', $menu1->route());
    }

    /**
     * Test to check if Menu class params
     *
     */
    public function test_menu_params()
    {
        $manager = new Builder();

        $manager->make('test_menu_1', function ($menu) {
            $menu->params(['test', 'test1']);
        });
        $menu1 = $manager->get('test_menu_1');
        $this->assertCount(2, $menu1->params());
    }

    /**
     * Test to check if Menu class icon
     *
     */
    public function test_menu_icon()
    {
        $manager = new Builder();

        $manager->make('test_menu_1', function ($menu) {
            $menu->icon('test_icon_name');
        });
        $menu1 = $manager->get('test_menu_1');
        $this->assertEquals('test_icon_name', $menu1->icon());
    }

    /**
     * Test to check if Menu class attributes
     *
     */
    public function test_menu_attributes()
    {
        $manager = new Builder();

        $manager->make('test_menu_1', function ($menu) {
            $menu->attributes(['key1' => 'value1', 'key2' => 'value2']);
        });
        $menu1 = $manager->get('test_menu_1');
        $this->assertCount(2, $menu1->attributes());
    }
}
