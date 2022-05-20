<?php

namespace AvoRed\Framework\Tests\Feature;

use AvoRed\Framework\Tests\TestCase;

class ConfigurationControllerTest extends TestCase
{
    /** @test */
    public function test_configuration_index_route_test()
    {
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.configuration.index'))
            ->assertStatus(200)
            ;
    }

    public function test_category_store_route_test()
    {
        $data = ['site_title' => 'test site title'];
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->post(route('admin.configuration.store', $data))
            ->assertRedirect(route('admin.configuration.index'));

        $this->assertDatabaseHas('configurations', ['code' => 'site_title']);
    }
}
