<?php

namespace AvoRed\Framework\Tests\Feature;

use AvoRed\Framework\Database\Models\Order;
use AvoRed\Framework\Tests\TestCase;

class OrderControllerTest extends TestCase
{
    /** @test */
    public function test_order_index_route_test()
    {
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.order.index'))
            ->assertStatus(200)
            ->assertSee(__('avored::system.order'));
    }

    /** @test */
    public function test_order_index_route_with_factory_data()
    {
        $order = Order::factory()->create();
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.order.index'))
            ->assertStatus(200)
            ->assertSee($order->shipping_option);
    }
}
