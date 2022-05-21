<?php

namespace AvoRed\Framework\Tests\UnitTests;

use AvoRed\Framework\Database\Contracts\AdminUserModelInterface;
use AvoRed\Framework\Database\Models\AdminUser;
use AvoRed\Framework\Tests\TestCase;
use Illuminate\Database\Query\Builder;
use Illuminate\Pagination\Paginator;

class BaseRepositoryTest extends TestCase
{
    public function test_base_repository_find_method()
    {
        $factoryAdminUser = AdminUser::factory()->create();
        $adminUser = app(AdminUserModelInterface::class)->find($factoryAdminUser->id);
        $this->assertEquals($factoryAdminUser->email, $adminUser->email);
        $this->assertDatabaseHas('admin_users', ['id' => $factoryAdminUser->id]);
    }

    public function test_base_repository_create_method()
    {
        $factoryAdminUser = AdminUser::factory()->make();
        $adminUser = app(AdminUserModelInterface::class)->create(array_merge(['password' => 'password'], $factoryAdminUser->toArray()));
        $this->assertEquals($factoryAdminUser->email, $adminUser->email);
        $this->assertDatabaseHas('admin_users', ['id' => $adminUser->id]);
    }

    public function test_base_repository_delete_method()
    {
        $factoryAdminUser = AdminUser::factory()->create();
        app(AdminUserModelInterface::class)->delete($factoryAdminUser->id);
        $this->assertDatabaseMissing('admin_users', ['id' => $factoryAdminUser->id]);
    }

    public function test_base_repository_all_method()
    {
        AdminUser::factory(3)->create();
        $allUsers = app(AdminUserModelInterface::class)->all();
        $this->assertEquals(3, $allUsers->count());
    }

    public function test_base_repository_paginate_method()
    {
        AdminUser::factory(30)->create();
        $allUsers = app(AdminUserModelInterface::class)->paginate();
        $this->assertNotInstanceOf(Paginator::class, $allUsers);
    }

    public function test_base_repository_query_method()
    {
        AdminUser::factory()->create();
        $allUsers = app(AdminUserModelInterface::class)->query();
        $this->assertNotInstanceOf(Builder::class, $allUsers);
    }
}
