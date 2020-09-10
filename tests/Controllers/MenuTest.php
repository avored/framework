<?php

namespace AvoRed\Framework\Tests\Controllers;

use AvoRed\Framework\Tests\BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MenuTest extends BaseTestCase
{
    use RefreshDatabase;

    public function testMenuIndexRouteTest()
    {
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.menu-group.index'))
            ->assertStatus(200);
    }

    public function testMenuCreateRouteTest()
    {
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.menu-group.create'))
            ->assertStatus(200);
    }

    public function testMenuStoreRouteTest()
    {
        $this->markTestIncomplete('Refactor Test');
        $data = ['name' => 'meun group name', 'identifier' => 'menu-group-name'];
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->post(route('admin.menu-group.store', $data))
            ->assertRedirect(route('admin.menu-group.index'));

        $this->assertDatabaseHas('menu_groups', ['name' => 'meun group name']);
    }
}
