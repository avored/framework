<?php

namespace AvoRed\Framework\Tests\Feature;

use AvoRed\Framework\Database\Models\Attribute;
use AvoRed\Framework\Tests\TestCase;

class AttributeControllerTest extends TestCase
{

    public function testAttributeIndexRouteTest()
    {
        $this->markTestIncomplete('todo implement feature');
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.attribute.index'))
            ->assertStatus(200)
            ->assertViewIs('avored::catalog.attribute.index');
    }

    public function testAttributeCreateRouteTest()
    {
        $this->markTestIncomplete('todo implement feature');
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.attribute.create'))
            ->assertStatus(200);
    }

    public function testAttributeStoreRouteTest()
    {
        $this->markTestIncomplete('todo implement feature');
        $data = [
            'name' => 'test attribute name',
            'slug' => 'test-attribute-name',
            'display_as' => 'TEXT'
        ];
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->post(route('admin.attribute.store', $data))
            ->assertRedirect(route('admin.attribute.index'));

        $this->assertDatabaseHas('attributes', ['name' => 'test attribute name']);
    }

    public function testAttributeEditRouteTest()
    {
        $this->markTestIncomplete('todo implement feature');
        $attribute = Attribute::factory()->create();
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.attribute.edit', $attribute->id))
            ->assertStatus(200);
    }

    public function testAttributeUpdateRouteTest()
    {
        $this->markTestIncomplete('todo implement feature');
        $attribute = Attribute::factory()->create();
        $attribute->dropdownOptions()->create(['display_text' => 'option 1']);
        $attribute->dropdownOptions()->create(['display_text' => 'option 2']);

        $attribute->name = 'updated attribute name';
        $attribute->dropdownOptions->first()->display_text = 'option updated';
        $data = $attribute->toArray();
        $data['dropdown_options'] = $data['dropdown'];
        unset($data['dropdown']);

        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->put(route('admin.attribute.update', $attribute->id), $data)
            ->assertRedirect(route('admin.attribute.index'));

        $this->assertDatabaseHas('attributes', ['name' => 'updated attribute name']);
    }

    public function testAttributeDestroyRouteTest()
    {
        $this->markTestIncomplete('todo implement feature');
        $attribute = Attribute::factory()->create();
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->delete(route('admin.attribute.destroy', $attribute->id))
            ->assertStatus(200);

        $this->assertDatabaseMissing('attributes', ['id' => $attribute->id]);
    }
}
