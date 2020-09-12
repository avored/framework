<?php

namespace AvoRed\Framework\Tests\Controllers;

use AvoRed\Framework\Tests\BaseTestCase;
use AvoRed\Framework\Database\Models\CustomerGroup;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerGroupTest extends BaseTestCase
{
    use RefreshDatabase;

    public function testCustomerGroupIndexRouteTest()
    {
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.customer-group.index'))
            ->assertStatus(200);
    }

    public function testCustomerGroupCreateRouteTest()
    {
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.customer-group.create'))
            ->assertStatus(200);
    }

    public function testCustomerGroupStoreRouteTest()
    {
        $data = ['name' => 'test customer-group name', 'is_default' => 1];
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->post(route('admin.customer-group.store', $data))
            ->assertRedirect(route('admin.customer-group.index'));

        $this->assertDatabaseHas('customer_groups', ['name' => 'test customer-group name']);
    }

    public function testCustomerGroupEditRouteTest()
    {
        $userGroup = factory(CustomerGroup::class)->create();
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.customer-group.edit', $userGroup->id))
            ->assertStatus(200);
    }

    public function testCustomerGroupUpdateRouteTest()
    {
        $userGroup = factory(CustomerGroup::class)->create();
        $userGroup->name = 'updated customer-group name';
        $data = $userGroup->toArray();

        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->put(route('admin.customer-group.update', $userGroup->id), $data)
            ->assertRedirect(route('admin.customer-group.index'));

        $this->assertDatabaseHas('customer_groups', ['name' => 'updated customer-group name']);
    }

    public function testCustomerGroupDestroyRouteTest()
    {
        $userGroup = factory(CustomerGroup::class)->create();

        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->delete(route('admin.customer-group.destroy', $userGroup->id))
            ->assertStatus(200);

        $this->assertDatabaseMissing('customer_groups', ['id' => $userGroup->id]);
    }
}
