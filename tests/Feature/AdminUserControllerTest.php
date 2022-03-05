<?php

namespace AvoRed\Framework\Tests\Feature;

use AvoRed\Framework\Database\Models\AdminUser;
use AvoRed\Framework\Database\Models\Role;
use AvoRed\Framework\Tests\TestCase;

class AdminUserControllerTest extends TestCase
{
    /** @test */
    public function test_admin_user_index_route_test()
    {
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.staff.index'))
            ->assertStatus(200)
            ->assertSee(__('avored::system.staff'));
    }

    /** @test */
    public function test_admin_user_create_route_test()
    {
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.staff.create'))
            ->assertStatus(200);
    }

    /** @test */
    public function test_admin_user_store_route_test()
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

    /** @test */
    public function test_admin_user_edit_route_test()
    {
        $adminUser = AdminUser::factory()->create();
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.staff.edit', $adminUser->id))
            ->assertStatus(200);
    }

    /** @test */
    public function test_admin_user_update_route_test()
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

    /** @test */
    public function test_admin_user_destroy_route_test()
    {
        $adminUser = AdminUser::factory()->create();

        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->delete(route('admin.staff.destroy', $adminUser->id))
            ->assertStatus(200);

        $this->assertDatabaseMissing('admin_users', ['id' => $adminUser->id]);
    }
}
