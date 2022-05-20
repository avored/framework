<?php

namespace AvoRed\Framework\Tests\Feature;

use AvoRed\Framework\Database\Models\Product;
use AvoRed\Framework\Tests\TestCase;

class ProductControllerTest extends TestCase
{
    /** @test */
    public function test_product_index_route()
    {
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.product.index'))
            ->assertStatus(200);
    }

    /** @test */
    public function test_product_createRoute()
    {
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.product.create'))
            ->assertStatus(200);
    }

    /** @test */
    public function test_product_store_route()
    {
        $data = [
            'name' => 'test product',
            'slug' => 'test-product',
            'type' => 'BASIC',
        ];
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->post(route('admin.product.store', $data))
            ->assertRedirect(route('admin.product.index'));
        $this->assertDatabaseHas('products', ['name' => 'test product']);
    }

    /** @test */
    public function test_product_edit_route()
    {
        $product = Product::factory()->create();
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.product.edit', $product))
            ->assertStatus(200)
            ->assertViewIs('avored::catalog.product.edit');
    }

    /** @test */
    public function test_product_update_route()
    {
        $product = Product::factory()->create();
        $product->name = 'update product name';
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->put(route('admin.product.update', $product), $product->toArray())
            ->assertRedirect(route('admin.product.index'));
        $this->assertDatabaseHas('products', ['name' => 'update product name']);
    }

    /** @test */
    public function test_product_destroy_route()
    {
        $product = Product::factory()->create();

        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->delete(route('admin.product.destroy', $product->id))
            ->assertStatus(200);

        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}
