<?php

namespace AvoRed\Framework\Tests\Controllers;

use AvoRed\Framework\Tests\BaseTestCase;
use AvoRed\Framework\Database\Models\Attribute;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AttributeTest extends BaseTestCase
{
    use RefreshDatabase;

    public function testAttributeIndexRouteTest()
    {
        $attribute = factory(Attribute::class)->create();
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.attribute.index'))
            ->assertStatus(200)
            ->assertSee($attribute->name);
    }

    public function testAttributeCreateRouteTest()
    {
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.attribute.create'))
            ->assertStatus(200);
    }

    public function testAttributeStoreRouteTest()
    {
        $data = [
            'name' => 'test attribute name',
            'slug' => 'test-attribute-name',
            'dropdown_option' => [
                'abc' => ['display_text' => 'option 1'],
                'xyz' => ['display_text' => 'option 2']
            ]
        ];
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->post(route('admin.attribute.store', $data))
            ->assertRedirect(route('admin.attribute.index'));

        $this->assertDatabaseHas('attributes', ['name' => 'test attribute name']);
    }

    public function testAttributeEditRouteTest()
    {
        $attribute = factory(Attribute::class)->create();
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.attribute.edit', $attribute->id))
            ->assertStatus(200);
    }

    public function testAttributeUpdateRouteTest()
    {
        $attribute = factory(Attribute::class)->create();
        $attribute->dropdownOptions()->create(['display_text' => 'option 1']);
        $attribute->dropdownOptions()->create(['display_text' => 'option 2']);

        $attribute->name = 'updated attribute name';
        $attribute->dropdownOptions->first()->display_text = 'option updated';
        $data = $attribute->toArray();

        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->put(route('admin.attribute.update', $attribute->id), $data)
            ->assertRedirect(route('admin.attribute.index'));

        $this->assertDatabaseHas('attributes', ['name' => 'updated attribute name']);
    }

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
