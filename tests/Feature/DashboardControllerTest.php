<?php

namespace AvoRed\Framework\Tests\Feature;

use AvoRed\Framework\Tests\TestCase;
class DashboardControllerTest extends TestCase
{
    /**
     * Test To check if login show form is working.
     * @return void
     */
    public function test_dashboard_route()
    {
        $response = $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->getAvoRed('admin.dashboard');

        $response->assertStatus(200);
    }
}
