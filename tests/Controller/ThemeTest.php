<?php

namespace AvoRed\Framework\Tests\Controller;

use AvoRed\Framework\Tests\BaseTestCase;

 /**
 * Test the theme Routes
 */
class ThemeTest extends BaseTestCase
{
    /**
     * Test the module Index Route
     * @test
     */
    public function test_theme_index_route()
    {
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'admin')->get(route('admin.theme.index'));
        
        $response->assertStatus(200)
            ->assertSee(__('avored-framework::system.theme-list'));
    }
   
}
