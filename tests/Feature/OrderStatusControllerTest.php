<?php

namespace AvoRed\Framework\Tests\Feature;

use AvoRed\Framework\Database\Models\OrderStatus;
use AvoRed\Framework\Tests\TestCase;

class OrderStatusControllerTest extends TestCase
{
    /** @test */
    public function test_order_status_index_route()
    {
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.order-status.index'))
            ->assertStatus(200);
    }

    /** @test */
    public function test_order_status_create_route()
    {
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.order-status.create'))
            ->assertStatus(200);
    }

    /** @test */
    public function test_order_status_store_route()
    {
        $data = ['name' => 'test order-status name', 'is_default' => 1];
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->post(route('admin.order-status.store', $data));

        $this->assertDatabaseHas('order_statuses', ['name' => 'test order-status name']);
    }

    public function testOrderStatusEditRouteTest()
    {
        $orderStatus = OrderStatus::factory()->create();
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.order-status.edit', $orderStatus->id))
            ->assertStatus(200);
    }

    public function testOrderStatusUpdateRouteTest()
    {
        $orderStatus = OrderStatus::factory()->create();
        $orderStatus->name = 'updated order-status name';
        $data = $orderStatus->toArray();

        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->put(route('admin.order-status.update', $orderStatus->id), $data)
            ->assertRedirect(route('admin.order-status.index'));

        $this->assertDatabaseHas('order_statuses', ['name' => 'updated order-status name']);
    }

    public function testOrderStatusDestroyRouteTest()
    {
        $orderStatus = OrderStatus::factory()->create();

        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->delete(route('admin.order-status.destroy', $orderStatus->id))
            ->assertStatus(200);

        $this->assertDatabaseMissing('order_statuses', ['id' => $orderStatus->id]);
    }
}
