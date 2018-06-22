<?php

namespace AvoRed\Framework\Tests\Widget;

use AvoRed\Framework\Tests\BaseTestCase;
use AvoRed\Framework\Widget\Manager;
use AvoRed\Framework\Widget\Widget;

class WidgetTest extends BaseTestCase
{
    /**
     * Test to check if Widget manager make
     *
     */
    public function test_widget_manager_make()
    {
        $widget1 = new Widget(function ($widget) {
            $widget->label('label');
        });
        $manager = new  Manager();
        $manager->make('test', $widget1);

        $this->assertInstanceOf(Widget::class, $manager->get('test'));
    }

    /**
     * Test to check if Widget  label
     *
     */
    public function test_widget_label()
    {
        $widget1 = new Widget(function ($widget) {
            $widget->label('label');
        });

        $this->assertEquals('label', $widget1->label());
    }

    /**
     * Test to check if Widget type
     *
     */
    public function test_widget_type()
    {
        $widget1 = new Widget(function ($widget) {
            $widget->type('type');
        });

        $this->assertEquals('type', $widget1->type());
    }

    /**
     * Test to check if Widget manager all
     *
     */
    public function test_widget_manager_all()
    {
        $manager = new  Manager();

        $widget1 = new Widget(function ($widget) {
            $widget->label('label1');
        });

        $manager->make('test1', $widget1);

        $widget1 = new Widget(function ($widget) {
            $widget->label('label2');
        });

        $manager->make('test2', $widget1);

        $allCount = $manager->all()->count();
        $this->assertEquals(2, $allCount);
    }
}
