<?php

namespace AvoRed\Framework\Tests\Controllers;

use AvoRed\Framework\Tests\BaseTestCase;
use AvoRed\Framework\Database\Models\Role;
use AvoRed\Framework\Database\Models\AdminUser;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminUserTest extends BaseTestCase
{
    use RefreshDatabase;

    public function testAdminUserIndexRouteTest()
    {
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.admin-user.index'))
            ->assertStatus(200)
            ->assertSee(__('avored::system.terms.admin_user'));
    }

    public function testAdminUserCreateRouteTest()
    {
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.admin-user.create'))
            ->assertStatus(200);
    }

    public function testAdminUserStoreRouteTest()
    {
        $role = factory(Role::class)->create();
        $data = [
            'first_name' => 'test admin-user name',
            'last_name' => 'test-admin-user-name',
            'is_super_admin' => 0,
            'email' => $this->faker->email,
            'role_id' => $role->id,
            'password' => 'randompassword',
            'password_confirmation' => 'randompassword',
            'language' => 'en',
        ];
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->post(route('admin.admin-user.store', $data))
            ->assertRedirect(route('admin.admin-user.index'));

        $this->assertDatabaseHas('admin_users', ['first_name' => 'test admin-user name']);
    }

    public function testAdminUserEditRouteTest()
    {
        $adminUser = factory(AdminUser::class)->create();
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.admin-user.edit', $adminUser->id))
            ->assertStatus(200);
    }

    public function testAdminUserUpdateRouteTest()
    {
        $adminUser = factory(AdminUser::class)->create();
        $adminUser->first_name = 'updated admin-user name';
        $adminUser->language = 'en';
        $data = $adminUser->toArray();

        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->put(route('admin.admin-user.update', $adminUser->id), $data)
            ->assertRedirect(route('admin.admin-user.index'));

        $this->assertDatabaseHas('admin_users', ['first_name' => 'updated admin-user name']);
    }

    public function testAdminUserDestroyRouteTest()
    {
        $adminUser = factory(AdminUser::class)->create();

        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->delete(route('admin.admin-user.destroy', $adminUser->id))
            ->assertStatus(200);

        $this->assertDatabaseMissing('admin_users', ['id' => $adminUser->id]);
    }
}
