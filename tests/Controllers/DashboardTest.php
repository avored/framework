<?php

namespace AvoRed\Framework\Tests\Controllers;

use AvoRed\Framework\Tests\BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DashboardTest extends BaseTestCase
{
    use RefreshDatabase;

    public function testDashboardRouteTest()
    {
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.dashboard'))
            ->assertStatus(200);
    }
}
