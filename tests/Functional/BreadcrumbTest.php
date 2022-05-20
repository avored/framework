<?php

namespace AvoRed\Framework\Tests\Functional;

use AvoRed\Framework\Breadcrumb\Builder;
use AvoRed\Framework\Tests\TestCase;
use Illuminate\View\View;

/** @runInSeparateProcess */
class BreadcrumbTest extends TestCase
{
    /** @test */
    public function test_breadcrumb_builder()
    {
        $builder = new Builder();
        $builder->make('test.route', function ($breadcrumb) {
            $breadcrumb->route('test.route');
        });
        $testRoute = $builder->get('test.route');
        $this->assertEquals($testRoute->route(), 'test.route');
    }

    /** @test */
    public function test_breadcrumb_builder_render()
    {
        $builder = new Builder();
        $builder->make('test.route', function ($breadcrumb) {
            $breadcrumb->route('test.route');
        });

        $this->assertInstanceOf(View::class, $builder->render('test.route'));
    }

    /** @test */
    public function test_breadcrumb_label()
    {
        $builder = new Builder();
        $builder->make('test.route', function ($breadcrumb) {
            $breadcrumb->label('test label');
        });
        $testRoute = $builder->get('test.route');
        $this->assertEquals($testRoute->label(), 'test label');
    }

    /** @test */
    public function test_breadcrumb_parent()
    {
        $builder = new Builder();
        $builder->make('test.route', function ($breadcrumb) {
            $breadcrumb->label('test parent label');
        });

        $builder->make('test.child.route', function ($breadcrumb) {
            $breadcrumb->label('test label')
                ->parent('test.route');
        });
        $testRoute = $builder->get('test.child.route');

        $this->assertEquals($testRoute->parents->count(), 1);
    }
}
