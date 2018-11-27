<?php

namespace AvoRed\Framework\Tests\Controller;

use AvoRed\Framework\Tests\BaseTestCase;
use AvoRed\Framework\Models\Database\User;

/**
 * Test the User Routes
 */
class UserTest extends BaseTestCase
{
    /**
     * Test the User Index Route
     * @test
     */
    public function test_user_index_route()
    {
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'admin')->get(route('admin.user.index'));
        
        $response->assertStatus(200);
    }
    /**
     * Test the User Create Route
     * @test
     */
    public function test_user_create_route()
    {
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'admin')->get(route('admin.user.create'));
        
        $response->assertStatus(200);
    }
   
    /**
     * Test the User Store Route
     * @test
     */
    public function test_user_edit_route()
    {
        $frontUser = factory(User::class)->create();
       
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'admin')
                        ->get(route('admin.user.edit', $frontUser->id));
        
        $response->assertStatus(200)
                ->assertSee($frontUser->first_name);
    }
    /**
     * Test the User Store Route
     * @test
     */
    public function test_user_update_route()
    {
        $frontUser = factory(User::class)->create();
        $frontUser->first_name = "test new name";
        
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'admin')
                        ->put(route('admin.user.update', $frontUser->id), $frontUser->toArray());
        
        $response->assertStatus(302)
                    ->assertRedirect(route('admin.user.index'));
        $this->assertDatabaseHas('users', [
                    'first_name' => 'test new name'
                ]);
    }
    /**
     * Test the User Store Route
     * @test
     */
    public function test_user_destroy_route()
    {
        $frontUser = factory(User::class)->create();
        
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'admin')
                        ->delete(route('admin.user.destroy', $frontUser->id));
        
        $response->assertStatus(302)
                    ->assertRedirect(route('admin.user.index'));
        $this->assertDatabaseMissing('users', [
                    'id' => $frontUser->id
                ]);
    }
}
