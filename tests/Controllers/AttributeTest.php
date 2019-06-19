<?php
namespace AvoRed\Framework\Tests\Controllers;

use AvoRed\Framework\Tests\BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use AvoRed\Framework\Database\Models\Attribute;

class AttributeTest extends BaseTestCase
{
    use RefreshDatabase;
    
    /* @runInSeparateProcess */
    public function testAttributeIndexRouteTest()
    {
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.attribute.index'))
            ->assertStatus(200)
            ->assertSee(__('avored::catalog.attribute.index.title'));
    }

    /* @runInSeparateProcess */
    public function testAttributeCreateRouteTest()
    {
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.attribute.create'))
            ->assertStatus(200)
            ->assertSee(__('avored::catalog.attribute.create.title'));
    }

    /* @runInSeparateProcess */
    public function testAttributeStoreRouteTest()
    {
        $data = ['name' => 'test attribute name','slug' => 'test-attribute-name'];
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->post(route('admin.attribute.store', $data))
            ->assertRedirect(route('admin.attribute.index'));

        $this->assertDatabaseHas('attributes', ['name' => 'test attribute name']);
    }

    /* @runInSeparateProcess */
    public function testAttributeEditRouteTest()
    {
        $attribute = factory(Attribute::class)->create();
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.attribute.edit', $attribute->id))
            ->assertStatus(200)
            ->assertSee(__('avored::catalog.attribute.edit.title'));
    }

    /* @runInSeparateProcess */
    public function testAttributeUpdateRouteTest()
    {
        $attribute = factory(Attribute::class)->create();
        $attribute->name = "updated attribute name";
        $data = $attribute->toArray();

        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->put(route('admin.attribute.update', $attribute->id), $data)
            ->assertRedirect(route('admin.attribute.index'));

        $this->assertDatabaseHas('attributes', ['name' => 'updated attribute name']);
    }

    /* @runInSeparateProcess */
    public function testAttributeDestroyRouteTest()
    {
        $attribute = factory(Attribute::class)->create();
        
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->delete(route('admin.attribute.destroy', $attribute->id))
            ->assertStatus(200);

        $this->assertDatabaseMissing('attributes', ['id' => $attribute->id]);
    }
}
