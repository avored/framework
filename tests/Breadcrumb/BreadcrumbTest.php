<?php

namespace AvoRed\Framework\Tests\Breadcrumb;

use PHPUnit\Framework\TestCase;
use AvoRed\Framework\Breadcrumb\Builder;

class BreadcrumbTest extends TestCase
{
    /**
     * Test to check if Builder can set the Breadcrumb Route
     *
     * @return void
     */
    public function test_breadcrumb_route()
    {
        $builder = new Builder();

        $builder->make('test.route', function($breadcrumb){
            $breadcrumb->route('test.route');     
        });
        $testRoute = $builder->get('test.route');

        $this->assertEquals($testRoute->route(), 'test.route');
    }
    /**
     * Test to check if Builder can set the Breadcrumb Label
     *
     * @return void
     */
    public function test_breadcrumb_label()
    {
        $builder = new Builder();
        
        $builder->make('test.route', function($breadcrumb){
            $breadcrumb->label('My Test Label');
        });    
        $testRoute = $builder->get('test.route');
        
        $this->assertEquals($testRoute->label(), 'My Test Label');
    }
 
}


