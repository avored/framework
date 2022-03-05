<?php

namespace AvoRed\Framework\Tests\Feature;

use AvoRed\Framework\Database\Models\Role;
use AvoRed\Framework\Permission\Permission;
use AvoRed\Framework\Tests\TestCase;

class RoleControllerTest extends TestCase
{
    /** @test */
    public function test_role_index_route()
    {
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.role.index'))
            ->assertStatus(200);
    }

    /** @test */
    public function test_role_create_route()
    {
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.role.create'))
            ->assertStatus(200);
    }

    /** @test */
    public function test_role_store_route()
    {
        $data = ['name' => 'test role name'];
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->post(route('admin.role.store', $data))
            ->assertRedirect(route('admin.role.index'));

        $this->assertDatabaseHas('roles', ['name' => 'test role name']);
    }

    /** @test */
    public function test_role_edit_route()
    {
        $role = Role::factory()->create();
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.role.edit', $role->id))
            ->assertStatus(200);
    }

    /** @test */
    public function test_role_update_route()
    {
        $role = Role::factory()->create();
        $role->name = 'updated role name';
        $data = $role->toArray();

        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->put(route('admin.role.update', $role->id), $data)
            ->assertRedirect(route('admin.role.index'));

        $this->assertDatabaseHas('roles', ['name' => 'updated role name']);
    }

    /** @test */
    public function test_role_destroy_route()
    {
        $role = Role::factory()->create();

        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->delete(route('admin.role.destroy', $role->id))
            ->assertStatus(200);

        $this->assertDatabaseMissing('roles', ['id' => $role->id]);
    }

    public function testRoleStoreWithPermissionsRouteTest()
    {
        $permissionList = Permission::all()->first()->permissionList;
        $permissions = collect();
        foreach ($permissionList as $permission) {
            $permissions->push($permission->routes());
        }

        $data = ['name' => 'test role name', 'permissions' => $permissions->toArray()];
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->post(route('admin.role.store', $data))
            ->assertRedirect(route('admin.role.index'));

        $this->assertDatabaseHas('roles', ['name' => 'test role name']);
    }

    public function testRoleUpdateWithPermissionsRouteTest()
    {
        $permissionList = Permission::all()->first()->permissionList;
        $permissions = collect();
        foreach ($permissionList as $permission) {
            $permissions->push($permission->routes());
        }

        $role = Role::factory()->create();
        $role->name = 'updated role name';
        $data = $role->toArray();
        $data['permissions'] = $permissions->toArray();

        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->put(route('admin.role.update', $role->id), $data)
            ->assertRedirect(route('admin.role.index'));

        $this->assertDatabaseHas('roles', ['name' => 'updated role name']);
    }
}
