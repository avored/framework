<?php

namespace AvoRed\Framework\Tests\Controller;

use AvoRed\Framework\Tests\BaseTestCase;
use AvoRed\Framework\Models\Contracts\CategoryInterface;
use AvoRed\Framework\Models\Database\Language;
use AvoRed\Framework\Models\Database\Category;

class CategoryTest extends BaseTestCase
{
    
    /** @test */
    public function admin_category_index_route()
    {
        $this
            ->adminuser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.category.index'))
            ->assertStatus(200)
            ->assertSee(__('avored-framework::product.category.title'));
    }

    /** @test */
    public function admin_category_create_route()
    {
        $this
            ->adminuser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.category.create'))
            ->assertStatus(200)
            ->assertSee(__('avored-framework::product.category.create_title'));  
    }

    /** @test */
    public function admin_category_store_route()
    {
        $category = factory(Category::class)->make();

        $data = array_merge(['language_id' => $this->defaultLanguage->id], $category->toArray());
        $this
            ->adminuser()
            ->actingAs($this->user, 'admin')
            ->post(route('admin.category.store', $data))
            ->assertRedirect(route('admin.category.index'));
        $this->assertDatabaseHas($category->getTable(), ['name' => $category->name]);
       
    }

    /** @test */
    public function admin_category_edit_route()
    {
        $category = factory(Category::class)->create();
        $this
            ->adminuser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.category.edit', $category->id))
            ->assertStatus(200)
            ->assertSee(__('avored-framework::product.category.edit_title'));
    }

    /** @test */
    public function admin_category_update_route()
    {
        $category = factory(Category::class)->create();
        $category->name = 'test new name';
        $data = array_merge(['language_id' => $this->defaultLanguage->id], $category->toArray());

        $res = $this
            ->adminuser()
            ->actingAs($this->user, 'admin')
            ->put(route('admin.category.update', $category->id), $data)
            ->assertRedirect(route('admin.category.index'));
            ;
       
        $this->assertDatabaseHas($category->getTable(), ['name' => 'test new name']);
       
    }

    /** @test */
    public function admin_category_destroy_route()
    {
        $category = factory(Category::class)->create();
        
        $res = $this
            ->adminuser()
            ->actingAs($this->user, 'admin')
            ->delete(route('admin.category.destroy', $category->id))
            ->assertRedirect(route('admin.category.index'));
            ;
       
        $this->assertDatabaseMissing($category->getTable(), ['id' => $category->id]);
       
    }
}
