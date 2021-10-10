<?php

namespace AvoRed\Framework\Tests\Feature;

use AvoRed\Framework\Database\Models\Product;
use AvoRed\Framework\Tests\TestCase;

class ProductControllerTest extends TestCase
{

    public function testProductIndexRouteTest()
    {
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.product.index'))
            ->assertStatus(200);
    }

    public function testProductCreateRouteTest()
    {
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.product.create'))
            ->assertStatus(200);
    }
    public function testProductStoreRouteTest()
    {
        $data = [
            'name' => 'test product',
            'slug' => 'test-product',
            'type' => 'BASIC'
        ];
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->post(route('admin.product.store', $data))
            ->assertRedirect(route('admin.product.index'));
            $this->assertDatabaseHas('products', ['name' => 'test product']);
    }
    public function testProductEditRouteTest()
    {
        $product = Product::factory()->create();
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.product.edit', $product))
            ->assertStatus(200)
            ->assertViewIs('avored::catalog.product.edit');
    }
    public function testProductUpdateRouteTest()
    {
        $product = Product::factory()->create();
        $product->name = 'update product name';
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->put(route('admin.product.update', $product), $product->toArray())
            ->assertRedirect(route('admin.product.index'));
            $this->assertDatabaseHas('products', ['name' => 'update product name']);
    }

    public function testProductDestroyRouteTest()
    {
        $product = Product::factory()->create();

        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->delete(route('admin.product.destroy', $product->id))
            ->assertStatus(200);

        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}
