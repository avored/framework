<?php

namespace AvoRed\Framework\Tests\Functional;

use Illuminate\View\View;
use AvoRed\Framework\Breadcrumb\Builder;
use AvoRed\Framework\Tests\BaseTestCase;

/** @runInSeparateProcess */
class BreadcrumbTest extends BaseTestCase
{
    public function testBreadcrumbBuilder()
    {
        $builder = new Builder();
        $builder->make('test.route', function ($breadcrumb) {
            $breadcrumb->route('test.route');
        });
        $testRoute = $builder->get('test.route');
        $this->assertEquals($testRoute->route(), 'test.route');
    }

    public function testBreadcrumbBuilderRender()
    {
        $builder = new Builder();
        $builder->make('test.route', function ($breadcrumb) {
            $breadcrumb->route('test.route');
        });

        $this->assertInstanceOf(View::class, $builder->render('test.route'));
    }

    public function testBreadcrumbLabel()
    {
        $builder = new Builder();
        $builder->make('test.route', function ($breadcrumb) {
            $breadcrumb->label('test label');
        });
        $testRoute = $builder->get('test.route');
        $this->assertEquals($testRoute->label(), 'test label');
    }

    public function testBreadcrumbParent()
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
