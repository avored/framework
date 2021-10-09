<?php

namespace AvoRed\Framework\Tests\Feature;

use AvoRed\Framework\Database\Models\AdminUser;
use AvoRed\Framework\Database\Models\Role;
use AvoRed\Framework\Tests\TestCase;

class AdminUserControllerTest extends TestCase
{
    public function testAdminUserIndexRouteTest()
    {
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.staff.index'))
            ->assertStatus(200)
            ->assertSee(__('avored::system.staff'));
    }

    public function testAdminUserCreateRouteTest()
    {
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.staff.create'))
            ->assertStatus(200);
    }

    public function testAdminUserStoreRouteTest()
    {
        $role = Role::factory()->create();
        $data = [
            'first_name' => 'test staff name',
            'last_name' => 'test-staff-name',
            'is_super_admin' => 0,
            'email' => $this->faker->email,
            'role_id' => $role->id,
            'password' => 'randompassword',
            'password_confirmation' => 'randompassword',
            'language' => 'en',
        ];
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->post(route('admin.staff.store', $data))
            ->assertRedirect(route('admin.staff.index'));

        $this->assertDatabaseHas('admin_users', ['first_name' => 'test staff name']);
    }

    public function testAdminUserEditRouteTest()
    {
        $adminUser = AdminUser::factory()->create();
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.staff.edit', $adminUser->id))
            ->assertStatus(200);
    }

    public function testAdminUserUpdateRouteTest()
    {
        $adminUser = AdminUser::factory()->create();
        $adminUser->first_name = 'updated staff name';
        $adminUser->language = 'en';
        $data = $adminUser->toArray();

        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->put(route('admin.staff.update', $adminUser->id), $data)
            ->assertRedirect(route('admin.staff.index'));

        $this->assertDatabaseHas('admin_users', ['first_name' => 'updated staff name']);
    }

    public function testAdminUserDestroyRouteTest()
    {
        $adminUser = AdminUser::factory()->create();

        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->delete(route('admin.staff.destroy', $adminUser->id))
            ->assertStatus(200);

        $this->assertDatabaseMissing('admin_users', ['id' => $adminUser->id]);
    }
}
