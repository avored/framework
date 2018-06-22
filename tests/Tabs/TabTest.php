<?php

namespace AvoRed\Framework\Tests\Tabs;

use AvoRed\Framework\Tests\BaseTestCase;
use AvoRed\Framework\Tabs\TabsMaker;
use AvoRed\Framework\Tabs\Tab;

class TabTest extends BaseTestCase
{
    /**
     * Test to check if Tab
     *
     */
    public function test_tab_maker_add()
    {
        $maker = new TabsMaker();
        $tab = new Tab();
        $tab->type('product');

        $maker->add('test1', $tab);
        $collection = $maker->all();

        $this->assertEquals(1, $collection->count());
    }

    /**
     * Test to check if Tab get
     *
     */
    public function test_tab_maker_get()
    {
        $maker = new TabsMaker();
        $tab = new Tab();
        $tab->type('product');

        $maker->add('test1', $tab);

        $this->assertInstanceOf(Tab::class, $maker->get('test1'));
    }

    /**
     * Test to check if Tab type
     *
     */
    public function test_tab_maker_type()
    {
        $maker = new TabsMaker();
        $tab = new Tab();
        $tab->type('product');

        $maker->add('test1', $tab);
        $tab = $maker->get('test1');

        $this->assertEquals('product', $tab->type());
    }

    /**
     * Test to check if Tab label
     *
     */
    public function test_tab_maker_label()
    {
        $maker = new TabsMaker();
        $tab = new Tab();
        $tab->type('product')->label('label');

        $maker->add('test1', $tab);
        $tab = $maker->get('test1');

        $this->assertEquals('label', $tab->label());
    }

    /**
     * Test to check if Tab label
     *
     */
    public function test_tab_maker_view()
    {
        $maker = new TabsMaker();
        $tab = new Tab();
        $tab->type('product')->view('view-file-path');

        $maker->add('test1', $tab);
        $tab = $maker->get('test1');

        $this->assertEquals('view-file-path', $tab->view());
    }
}
