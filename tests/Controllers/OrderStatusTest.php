<?php

namespace AvoRed\Framework\Tests\Controllers;

use AvoRed\Framework\Tests\BaseTestCase;
use AvoRed\Framework\Database\Models\OrderStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderStatusTest extends BaseTestCase
{
    use RefreshDatabase;

    public function testOrderStatusIndexRouteTest()
    {
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.order-status.index'))
            ->assertStatus(200);
    }

    public function testOrderStatusCreateRouteTest()
    {
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.order-status.create'))
            ->assertStatus(200);
    }

    public function testOrderStatusStoreRouteTest()
    {
        $data = ['name' => 'test order-status name', 'is_default' => 1];
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->post(route('admin.order-status.store', $data))
            ->assertRedirect(route('admin.order-status.index'));

        $this->assertDatabaseHas('order_statuses', ['name' => 'test order-status name']);
    }

    public function testOrderStatusEditRouteTest()
    {
        $orderStatus = factory(OrderStatus::class)->create();
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.order-status.edit', $orderStatus->id))
            ->assertStatus(200);
    }

    public function testOrderStatusUpdateRouteTest()
    {
        $orderStatus = factory(OrderStatus::class)->create();
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
        $orderStatus = factory(OrderStatus::class)->create();

        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->delete(route('admin.order-status.destroy', $orderStatus->id))
            ->assertStatus(200);

        $this->assertDatabaseMissing('order_statuses', ['id' => $orderStatus->id]);
    }
}
