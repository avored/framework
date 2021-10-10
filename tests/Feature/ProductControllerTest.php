<?php

namespace AvoRed\Framework\Tests\Feature;

use AvoRed\Framework\Tests\TestCase;

class ProductControllerTest extends TestCase
{

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
