<?php

namespace AvoRed\Framework\Tests\Controller;

use AvoRed\Framework\Tests\BaseTestCase;
use AvoRed\Framework\Models\Database\Role;
use AvoRed\Framework\Models\Database\UserGroup;

 /**
 * Test the Configuration Routes
 */
class ConfigurationTest extends BaseTestCase
{
    /**
     * Test the Configuration Index Route
     * @test
     */
    public function test_admin_configuration_index_route()
    {
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'admin')->get(route('admin.configuration'));
        
        $response->assertStatus(200)
                    ->assertSee('Configuration');
    }
    /**
     * Test the Configuration Store Route
     * @test
     */
    public function test_admin_configuration_store_route()
    {
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'admin')
                        ->post(
                            route('admin.configuration.store'), 
                            ['general_site_title' => 'New Site Title']
                        );
        $response->assertStatus(302)
                ->assertRedirect(route('admin.configuration'))
                ->assertSessionHas('notificationText', 'All Configuration saved!');
                
        $this->assertDatabaseHas(
            'configurations',
            ['configuration_key' => 'general_site_title',
            'configuration_value' => 'New Site Title']
        );
    }

}
