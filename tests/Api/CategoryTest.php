<?php

namespace AvoRed\Framework\Tests\Api;

use AvoRed\Framework\Tests\BaseTestCase;
use AvoRed\Framework\Models\Database\Category;

class CategoryTest extends BaseTestCase
{
    /** @test */
    public function test_category_api_list_route()
    {
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'api')->get('api/v1/category');
        $response->assertStatus(200);
    }

    /** @test */
    public function test_category_api_store_route()
    {
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'api')
            ->post('api/v1/category', [
                'name' => 'test name',
                'slug' => 'test-name'
            ]);
        $response->assertStatus(201);

        $this->assertDatabaseHas(
            'categories', 
            ['name' => 'test name']
        );
    }
   
    /** @test */
    public function test_category_api_show_route()
    {
        $category = factory(Category::class)->create();
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'api')->get('api/v1/category/' . $category->id);
        $data = json_decode($response->content());

        $response->assertStatus(200);
        $this->assertEquals($category->name ,$data->data->name);
    }

    /** @test */
    public function test_category_api_update_route()
    {
        $category = factory(Category::class)->create();
        $category->name = 'new name';
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'api')->put('api/v1/category/' . $category->id, $category->toArray());
        $data = json_decode($response->content());

        $response->assertStatus(200);
        $this->assertEquals('new name', $data->data->name);
        $this->assertDatabaseHas(
            'categories', 
            ['name' => 'new name']
        );
    }

    /** @test */
    public function test_category_api_delete_route()
    {
        $category = factory(Category::class)->create();
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'api')->delete('api/v1/category/' . $category->id);
        
        $response->assertStatus(204);
        $this->assertDatabaseMissing(
            'categories', 
            ['id' => $category->id]
        );
    }
}
