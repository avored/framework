<?php

namespace AvoRed\Framework\Tests\Controller;

use AvoRed\Framework\Tests\BaseTestCase;
use AvoRed\Framework\Models\Database\Role;
use AvoRed\Framework\Models\Database\UserGroup;

 /**
 * Test the Customer Group Routes
 */
class UserGroupTest extends BaseTestCase
{
    /*** @test */
    public function test_user_group_index_route()
    {
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'admin')->get(route('admin.user-group.index'));
        
        $response->assertStatus(200);
    }

    /*** @test */
    public function test_user_group_create_route()
    {
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'admin')->get(route('admin.user-group.create'));
        
        $response->assertStatus(200);
    }
    /**
     * Test the Customer Group Store Route
     * @test
     */
    public function test_user_group_store_route()
    {
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'admin')
                        ->post(route('admin.user-group.store', [
                            'name' => 'test group name',
                            //'is_default' => 0 we should not return checkbox value if not checked
                        ]));
        
        $response->assertStatus(302)
                ->assertRedirect(route('admin.user-group.index'));
                
        $this->assertDatabaseHas('user_groups', [
                    'name' => 'test group name'
                ]);
    }

    /*** @test */
    public function test_user_group_edit_route()
    {
        $userGroup = factory(UserGroup::class)->create();
        
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'admin')
                        ->get(route('admin.user-group.edit', $userGroup->id));
        
        $response->assertStatus(200)
                ->assertSee($userGroup->name);
    }
    
    /*** @test */
    public function test_user_group_update_route()
    {
        $userGroup = factory(UserGroup::class)->create();
        $userGroup->name = "test new name";
        
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'admin')
                        ->put(route('admin.user-group.update', $userGroup->id), $userGroup->toArray());
        
        $response->assertStatus(302)
                    ->assertRedirect(route('admin.user-group.index'));
        $this->assertDatabaseHas('user_groups', [
                    'name' => 'test new name'
                ]);
    }
   
    /*** @test */
    public function test_user_group_destroy_route()
    {
        $userGroup = factory(UserGroup::class)->create();
        
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'admin')
                        ->delete(route('admin.user-group.destroy', $userGroup->id));
        
        $response->assertStatus(302)
                    ->assertRedirect(route('admin.user-group.index'));
        $this->assertDatabaseMissing('user_groups', [
                    'id' => $userGroup->id
                ]);
    }
}
