<?php

namespace AvoRed\Framework\Tests\Feature;

use AvoRed\Framework\Database\Models\Category;
use AvoRed\Framework\Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    /** @test */
    public function test_category_page_index_form()
    {
        $response = $this->getAvoRed('admin.category.index');

        $response->assertStatus(200)
            ->assertViewIs('avored::catalog.category.index');
    }

    /** @test */
    public function test_category_page_create_form()
    {
        $response = $this->getAvoRed('admin.category.create');

        $response->assertStatus(200)
            ->assertViewIs('avored::catalog.category.create');
    }

    /** @test */
    public function test_category_page_store_form()
    {
        $data = Category::factory()->make();
        $this
            ->postAvoRed('admin.category.store', $data->toArray())
            ->assertStatus(302)
            ->assertRedirect(route('admin.category.index'));

        $this->assertDatabaseHas('categories', ['name' => $data->name, 'slug' => $data->slug]);
    }

    /** @test */
    public function test_category_page_edit_form()
    {
        $category = Category::factory()->create();
        $response = $this->createAdminUser(['is_super_admin' => 1])
            ->actingAs($this->user, 'admin')
            ->get(route('admin.category.edit', $category));
        $response->assertStatus(200)
            ->assertViewIs('avored::catalog.category.edit');
    }

    /** @test */
    public function test_category_page_update_form()
    {
        $category = Category::factory()->create();
        $category->name = 'unit test update';

        $this->createAdminUser(['is_super_admin' => 1])
            ->actingAs($this->user, 'admin')
            ->put(route('admin.category.update', $category), $category->toArray())
            ->assertStatus(302)
            ->assertRedirect(route('admin.category.index'));

        $this->assertDatabaseHas('categories', ['name' => 'unit test update', 'slug' => $category->slug]);
    }

    /** @test */
    public function test_category_page_destroy_form()
    {
        $category = Category::factory()->create();

        $this->createAdminUser(['is_super_admin' => 1])
            ->actingAs($this->user, 'admin')
            ->delete(route('admin.category.update', $category))
            ->assertStatus(200);

        $this->assertDatabaseMissing('categories', ['name' => 'unit test update', 'slug' => $category->slug]);
    }

    public function test_graphql_query_all_categories()
    {
        $category = Category::factory()->create();
        $this->query('allCategory', [], ['id'])
            ->assertSuccessful()
            ->assertJsonFragment(['id' => $category->id]);
    }

    public function test_graphql_query_category()
    {
        $category = Category::factory()->create();
        $this->query('category', ['slug' => $category->slug], ['id'])
            ->assertSuccessful()
            ->assertJsonFragment(['id' => $category->id]);
    }
}
