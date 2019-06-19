<?php

namespace AvoRed\Framework\Tests\Controllers;

use AvoRed\Framework\Tests\BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use AvoRed\Framework\Database\Models\Language;

class LanguageTest extends BaseTestCase
{
    use RefreshDatabase;
    
    /* @runInSeparateProcess */
    public function testLanguageIndexRouteTest()
    {
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.language.index'))
            ->assertStatus(200)
            ->assertSee(__('avored::system.language.index.title'));
    }

    /* @runInSeparateProcess */
    public function testLanguageCreateRouteTest()
    {
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.language.create'))
            ->assertStatus(200)
            ->assertSee(__('avored::system.language.create.title'));
    }

    /* @runInSeparateProcess */
    public function testLanguageStoreRouteTest()
    {
        $data = ['name' => 'test language name', 'code' => 'en'];
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->post(route('admin.language.store', $data))
            ->assertRedirect(route('admin.language.index'));

        $this->assertDatabaseHas('languages', ['name' => 'test language name']);
    }

    /* @runInSeparateProcess */
    public function testLanguageEditRouteTest()
    {
        $language = factory(Language::class)->create();
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.language.edit', $language->id))
            ->assertStatus(200)
            ->assertSee(__('avored::system.language.edit.title'));
    }

    /* @runInSeparateProcess */
    public function testLanguageUpdateRouteTest()
    {
        $language = factory(Language::class)->create();
        $language->name = "updated language name";
        $data = $language->toArray();

        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->put(route('admin.language.update', $language->id), $data)
            ->assertRedirect(route('admin.language.index'));

        $this->assertDatabaseHas('languages', ['name' => 'updated language name']);
    }

    /* @runInSeparateProcess */
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
