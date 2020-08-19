<?php

namespace AvoRed\Framework\Tests\Controllers;

use AvoRed\Framework\Tests\BaseTestCase;
use AvoRed\Framework\Database\Models\Language;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LanguageTest extends BaseTestCase
{
    use RefreshDatabase;

    public function testLanguageIndexRouteTest()
    {
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.language.index'))
            ->assertStatus(200);
    }

    public function testLanguageCreateRouteTest()
    {
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.language.create'))
            ->assertStatus(200);
    }

    public function testLanguageStoreRouteTest()
    {
        $data = ['name' => 'test language name', 'code' => 'en'];
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->post(route('admin.language.store', $data))
            ->assertRedirect(route('admin.language.index'));

        $this->assertDatabaseHas('languages', ['name' => 'test language name']);
    }

    public function testLanguageEditRouteTest()
    {
        $language = factory(Language::class)->create();
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.language.edit', $language->id))
            ->assertStatus(200);
    }

    public function testLanguageUpdateRouteTest()
    {
        $language = factory(Language::class)->create();
        $language->name = 'updated language name';
        $data = $language->toArray();

        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->put(route('admin.language.update', $language->id), $data)
            ->assertRedirect(route('admin.language.index'));

        $this->assertDatabaseHas('languages', ['name' => 'updated language name']);
    }

    public function testLanguageDestroyRouteTest()
    {
        $language = factory(Language::class)->create();

        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->delete(route('admin.language.destroy', $language->id))
            ->assertStatus(200);

        $this->assertDatabaseMissing('languages', ['id' => $language->id]);
    }
}
