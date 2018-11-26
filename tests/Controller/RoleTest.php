<?php

namespace AvoRed\Framework\Tests\Controller;

use AvoRed\Framework\Tests\BaseTestCase;
use AvoRed\Framework\Models\Database\Role;

class RoleTest extends BaseTestCase
{
   /**
     * Test the Role Index Route
     * @test
     */
    public function test_role_index_route()
    {
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'admin')->get(route('admin.role.index'));
        
        $response->assertStatus(200);
    }
    /**
     * Test the Role Create Route
     * @test
     */
    public function test_role_create_route()
    {
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'admin')->get(route('admin.role.create'));
        
        $response->assertStatus(200);
    }
    /**
     * Test the Role Store Route
     * @test
     */
    public function test_role_store_route()
    {
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'admin')
                        ->post(route('admin.role.store', [
                            'name' => 'test role name',
                            'permissions' => [
                                'admin.page.index',
                                'admin.page.create,admin.page.store'
                            ]
                        ]));
        
        $response->assertStatus(302)
                ->assertRedirect(route('admin.role.index'));
                
        $this->assertDatabaseHas('roles', [
                    'name' => 'test role name'
                ]);
    }
    /**
     * Test the Role Store Route
     * @test
     */
    public function test_role_edit_route()
    {
        $role = factory(Role::class)->create();
        
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'admin')
                        ->get(route('admin.role.edit', $role->id));
        
        $response->assertStatus(200)
                ->assertSee($role->name);
    }
    /**
     * Test the Role Store Route
     * @test
     */
    public function test_role_update_route()
    {
        $role = factory(Role::class)->create();
        $role->name = "test new name";
        
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'admin')
                        ->put(
                            route('admin.role.update', $role->id), 
                            array_merge($role->toArray(), ['permissions' => ['admin.page.index']])
                        );
        
        $response->assertStatus(302)
                    ->assertRedirect(route('admin.role.index'));
        $this->assertDatabaseHas('roles', [
                    'name' => 'test new name'
                ]);
    }
    /**
     * Test the Role Store Route
     * @test
     */
    public function test_role_destroy_route()
    {
        $role = factory(Role::class)->create();
        
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'admin')
                        ->delete(route('admin.role.destroy', $role->id));
        
        $response->assertStatus(302)
                    ->assertRedirect(route('admin.role.index'));
        $this->assertDatabaseMissing('roles', [
                    'id' => $role->id
                ]);
    }

   
}
