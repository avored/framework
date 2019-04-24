<?php

namespace AvoRed\Framework\Tests\Controllers;

use AvoRed\Framework\Tests\BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoleTest extends BaseTestCase
{
    use RefreshDatabase;
    
    /* @runInSeparateProcess */
    public function testRoleRouteTest()
    {
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.role.index'))
            ->assertStatus(200)
            ->assertSee(__('avored::system.role.index.title'));
    }
}
