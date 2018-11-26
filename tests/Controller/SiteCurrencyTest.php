<?php

namespace AvoRed\Framework\Tests\Controller;

use AvoRed\Framework\Tests\BaseTestCase;
use AvoRed\Framework\Models\Database\Role;
use AvoRed\Framework\Models\Database\UserGroup;
use AvoRed\Framework\Models\Database\SiteCurrency;

 /**
 * Test the Site Currency Routes
 */
class SiteCurrencyTest extends BaseTestCase
{
    /**
     * Test the Site Currency Index Route
     * @test
     */
    public function test_site_currency_index_route()
    {
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'admin')->get(route('admin.site-currency.index'));
        
        $response->assertStatus(200)
            ->assertSee(__('avored-framework::system.site-currency.title'));
    }
    /**
     * Test the Site Currency Create Route
     * @test
     */
    public function test_site_currency_create_route()
    {
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'admin')->get(route('admin.site-currency.create'));
        
        $response->assertStatus(200)
            ->assertSee(__('avored-framework::system.site-currency.create'));
    }
    /**
     * Test the Site Currency Store Route
     * @test
     */
    public function test_site_currency_store_route()
    {
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'admin')
                        ->post(route('admin.site-currency.store', [
                            'name' => 'currency name',
                            'code' => 'NZD',
                            'symbol' => '$',
                            'conversion_rate' => 1.00,
                            'status' => 'ENABLED'
                        ]));
        
        $response->assertStatus(302)
                ->assertRedirect(route('admin.site-currency.index'));
                
        $this->assertDatabaseHas('site_currencies', [
                    'name' => 'currency name'
                ]);
    }
    /**
     * Test the Site Currency Store Route
     * @test
     */
    public function test_site_currency_edit_route()
    {
        $siteCurrency = factory(SiteCurrency::class)->create();
        
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'admin')
                        ->get(route('admin.site-currency.edit', $siteCurrency->id));
        
        $response->assertStatus(200)
            ->assertSee(__('avored-framework::system.site-currency.update'))
            ->assertSee($siteCurrency->name);
    }
    /**
     * Test the Site Currency Store Route
     * @test
     */
    public function test_site_currency_update_route()
    {
        $siteCurrency = factory(SiteCurrency::class)->create();
        $siteCurrency->name = "test new name";
        
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'admin')
            ->put(route('admin.site-currency.update', $siteCurrency->id), $siteCurrency->toArray());
        
        $response->assertStatus(302)
            ->assertRedirect(route('admin.site-currency.index'));
        $this->assertDatabaseHas(
            'site_currencies', 
            ['name' => 'test new name']
        );
    }
    /**
     * Test the Site Currency Store Route
     * @test
     */
    public function test_site_currency_destroy_route()
    {
        $siteCurrency = factory(SiteCurrency::class)->create();
        
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'admin')
            ->delete(route('admin.site-currency.destroy', $siteCurrency->id));
        
        $response->assertStatus(302)
            ->assertRedirect(route('admin.site-currency.index'));
            
        $this->assertDatabaseMissing(
            'site_currencies', 
            ['id' => $siteCurrency->id]
        );
    }
}
