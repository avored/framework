<?php

namespace AvoRed\Framework\Tests\Feature;

use AvoRed\Framework\Tests\TestCase;

class ConfigurationControllerTest extends TestCase
{
    public function testConfigurationIndexRouteTest()
    {
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.configuration.index'))
            ->assertStatus(200)
            ;
    }

    public function testCategoryStoreRouteTest()
    {
        $data = ['site_title' => 'test site title'];
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->post(route('admin.configuration.store', $data))
            ->assertRedirect(route('admin.configuration.index'));

        $this->assertDatabaseHas('configurations', ['code' => 'site_title']);
    }
}