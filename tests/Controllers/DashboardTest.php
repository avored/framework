<?php

namespace AvoRed\Framework\Tests\Controllers;

use AvoRed\Framework\Tests\BaseTestCase;

class DashboardTest extends BaseTestCase
{
    /**
     * Test to check if admin dashboard get controller is working
     *
     * @return void
     */
    public function testDashboardRouteTest()
    {
        $this->assertTrue(true);
        $res = $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.dashboard'))
            ->assertStatus(200);
    }
}
