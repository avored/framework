<?php

namespace AvoRed\Framework\Tests\Controllers;

use AvoRed\Framework\Tests\BaseTestCase;
use AvoRed\Framework\Database\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends BaseTestCase
{
    use RefreshDatabase;

    public function testCategoryIndexRouteTest()
    {
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.category.index'))
            ->assertStatus(200);
    }

    public function testCategoryCreateRouteTest()
    {
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.category.create'))
            ->assertStatus(200);
    }

    public function testCategoryStoreRouteTest()
    {
        $data = ['name' => 'test category name', 'slug' => 'test-category-name'];
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->post(route('admin.category.store', $data))
            ->assertRedirect(route('admin.category.index'));

        $this->assertDatabaseHas('categories', ['name' => 'test category name']);
    }

    public function testCategoryEditRouteTest()
    {
        $category = factory(Category::class)->create();
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.category.edit', $category->id))
            ->assertStatus(200);
    }

    public function testCategoryUpdateRouteTest()
    {
        $category = factory(Category::class)->create();
        $category->name = 'updated category name';
        $data = $category->toArray();

        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->put(route('admin.category.update', $category->id), $data)
            ->assertRedirect(route('admin.category.index'));

        $this->assertDatabaseHas('categories', ['name' => 'updated category name']);
    }

    public function testCategoryDestroyRouteTest()
    {
        $category = factory(Category::class)->create();

        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->delete(route('admin.category.destroy', $category->id))
            ->assertStatus(200);

        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }
}
