<?php

namespace AvoRed\Framework\Tests\Controller;

use AvoRed\Framework\Tests\BaseTestCase;
use AvoRed\Framework\Models\Database\Role;
use AvoRed\Framework\Models\Database\UserGroup;
use AvoRed\Framework\Models\Database\SiteCurrency;
use AvoRed\Framework\Models\Database\State;
use AvoRed\Framework\Models\Database\Country;

 /**
 * Test the state Routes
 */
class StateTest extends BaseTestCase
{
    /**
     * Test the state Index Route
     * @test
     */
    public function test_state_index_route()
    {
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'admin')->get(route('admin.state.index'));
        
        $response->assertStatus(200)
            ->assertSee(__('avored-framework::system.state-list'));
    }
    /**
     * Test the state Create Route
     * @test
     */
    public function test_state_create_route()
    {
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'admin')->get(route('admin.state.create'));
        
        $response->assertStatus(200)
            ->assertSee(__('avored-framework::system.state-create'));
    }
    /**
     * Test the state Store Route
     * @test
     */
    public function test_state_store_route()
    {
        $user = $this->_getAdminUser();
        $country = factory(Country::class)->create();
        $response = $this->actingAs($user, 'admin')
                        ->post(route('admin.state.store', [
                            'name' => 'state for new zealand',
                            'code' => 'state_code',
                            'country_id' => $country->id,
                        ]));
        
        $response->assertStatus(302)
                ->assertRedirect(route('admin.state.index'));
                
        $this->assertDatabaseHas('states', [
                    'name' => 'state for new zealand'
                ]);
    }
    /**
     * Test the state Store Route
     * @test
     */
    public function test_state_edit_route()
    {
        $state = factory(state::class)->create();
        
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'admin')
                        ->get(route('admin.state.edit', $state->id));
        
        $response->assertStatus(200)
            ->assertSee(__('avored-framework::system.state-update'))
            ->assertSee($state->name);
    }
    /**
     * Test the state Store Route
     * @test
     */
    public function test_state_update_route()
    {
        $state = factory(state::class)->create();
        $state->name = "test new name";
        
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'admin')
            ->put(route('admin.state.update', $state->id), $state->toArray());
        
        $response->assertStatus(302)
            ->assertRedirect(route('admin.state.index'));
        $this->assertDatabaseHas(
            'states', 
            ['name' => 'test new name']
        );
    }
    /**
     * Test the state Store Route
     * @test
     */
    public function test_state_destroy_route()
    {
        $state = factory(state::class)->create();
        
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'admin')
            ->delete(route('admin.state.destroy', $state->id));
        
        $response->assertStatus(302)
            ->assertRedirect(route('admin.state.index'));
            
        $this->assertDatabaseMissing(
            'states', 
            ['id' => $state->id]
        );
    }
}
