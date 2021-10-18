<?php

namespace AvoRed\Framework\Tests\Feature;

use AvoRed\Framework\Database\Models\Order;
use AvoRed\Framework\Tests\TestCase;

class OrderControllerTest extends TestCase
{
    public function testOrderIndexRouteTest()
    {
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.order.index'))
            ->assertStatus(200)
            ->assertSee(__('avored::system.order'));
    }
    public function testOrderIndexRouteWithFactoryDataTest()
    {
        $order = Order::factory()->create();
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.order.index'))
            ->assertStatus(200)
            ->assertSee($order->shipping_option);
    }
}
