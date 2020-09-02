<?php

namespace AvoRed\Framework\Tests\Controllers;

use AvoRed\Framework\Tests\BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends BaseTestCase
{
    use RefreshDatabase;

    public function testProductIndexRouteTest()
    {
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.product.index'))
            ->assertStatus(200);
    }

    public function testProductCreateRouteTest()
    {
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.product.create'))
            ->assertStatus(200);
    }
}
