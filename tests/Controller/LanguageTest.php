<?php

namespace AvoRed\Framework\Tests\Controller;

use AvoRed\Framework\Tests\BaseTestCase;
use AvoRed\Framework\Models\Database\Language;

/**
 * Test the Language Routes
 */
class LanguageTest extends BaseTestCase
{
    /**
     * Test the Language Index Route
     */
    public function test_language_index_route()
    {
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'admin')->get(route('admin.language.index'));
        
        $response->assertStatus(200)
            ->assertSee(__('avored-framework::system.language.title'));
    }
    /**
     * Test the Language Create Route
     */
    public function test_language_create_route()
    {
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'admin')->get(route('admin.language.create'));
        
        $response->assertStatus(200)
            ->assertSee(__('avored-framework::system.language.create'));
    }
    /**
     * Test the Language Store Route
     */
    public function test_language_store_route()
    {
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'admin')
                        ->post(route('admin.language.store', [
                            'name' => 'language name',
                            'code' => 'en',
                            'is_default' => 0
                        ]));
        
        $response->assertStatus(302)
                ->assertRedirect(route('admin.language.index'));
                
        $this->assertDatabaseHas('languages', [
                    'name' => 'language name'
                ]);
    }
    /**
     * Test the Language Store Route
     */
    public function test_language_edit_route()
    {
        $language = factory(Language::class)->create();
        
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'admin')
                        ->get(route('admin.language.edit', $language->id));
        
        $response->assertStatus(200)
            ->assertSee(__('avored-framework::system.language.update'))
            ->assertSee($language->name);
    }
    /**
     * Test the Language Store Route
     */
    public function test_language_update_route()
    {
        $language = factory(Language::class)->create();
        $language->name = "test new name";
        
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'admin')
            ->put(route('admin.language.update', $language->id), $language->toArray());
        
        $response->assertStatus(302)
            ->assertRedirect(route('admin.language.index'));
        $this->assertDatabaseHas(
            'languages', 
            ['name' => 'test new name']
        );
    }
    /**
     * Test the Language Store Route
     */
    public function test_language_destroy_route()
    {
        $language = factory(Language::class)->create();
        
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'admin')
            ->delete(route('admin.language.destroy', $language->id));
        $response->assertStatus(302)
            ->assertRedirect(route('admin.language.index'));
            
        $this->assertDatabaseMissing(
            'languages', 
            ['id' => $language->id]
        );
    }
}
