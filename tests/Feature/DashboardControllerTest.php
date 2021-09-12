<?php

namespace AvoRed\Framework\Tests\Feature;

use AvoRed\Framework\Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DashboardControllerTest extends TestCase
{
    use RefreshDatabase, DatabaseMigrations;

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
