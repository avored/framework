<?php

namespace AvoRed\Framework\Tests\Controller;

use AvoRed\Framework\Tests\BaseTestCase;
use AvoRed\Framework\Models\Database\Role;
use AvoRed\Framework\Models\Database\UserGroup;
use AvoRed\Framework\Models\Database\SiteCurrency;
use AvoRed\Framework\Models\Database\Country;

 /**
 * Test the Country Routes
 */
class CountryTest extends BaseTestCase
{
    /**
     * Test the Country Index Route
     * @test
     */
    public function test_country_index_route()
    {
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'admin')->get(route('admin.country.index'));
        
        $response->assertStatus(200)
            ->assertSee(__('avored-framework::system.country-list'));
    }
    /**
     * Test the Country Create Route
     * @test
     */
    public function test_country_create_route()
    {
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'admin')->get(route('admin.country.create'));
        
        $response->assertStatus(200)
            ->assertSee(__('avored-framework::system.country-create'));
    }
    /**
     * Test the Country Store Route
     * @test
     */
    public function test_country_store_route()
    {
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'admin')
                        ->post(route('admin.country.store', [
                            'name' => 'new zealand',
                            'code' => 'nz',
                            'phone_code' => '0064',
                            'lang_code' => 'en',
                            
                        ]));
        
        $response->assertStatus(302)
                ->assertRedirect(route('admin.country.index'));
                
        $this->assertDatabaseHas('countries', [
                    'name' => 'new zealand'
                ]);
    }
    /**
     * Test the Country Store Route
     * @test
     */
    public function test_country_edit_route()
    {
        $country = factory(Country::class)->create();
        
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'admin')
                        ->get(route('admin.country.edit', $country->id));
        
        $response->assertStatus(200)
            ->assertSee(__('avored-framework::system.country-update'))
            ->assertSee($country->name);
    }
    /**
     * Test the Country Store Route
     * @test
     */
    public function test_country_update_route()
    {
        $country = factory(Country::class)->create();
        $country->name = "test new name";
        
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'admin')
            ->put(route('admin.country.update', $country->id), $country->toArray());
        
        $response->assertStatus(302)
            ->assertRedirect(route('admin.country.index'));
        $this->assertDatabaseHas(
            'countries', 
            ['name' => 'test new name']
        );
    }
    /**
     * Test the Country Store Route
     * @test
     */
    public function test_country_destroy_route()
    {
        $country = factory(Country::class)->create();
        
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'admin')
            ->delete(route('admin.country.destroy', $country->id));
        
        $response->assertStatus(302)
            ->assertRedirect(route('admin.country.index'));
            
        $this->assertDatabaseMissing(
            'countries', 
            ['id' => $country->id]
        );
    }
}
