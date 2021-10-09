<?php

namespace AvoRed\Framework\Tests\Feature;

use AvoRed\Framework\Database\Models\Page;
use AvoRed\Framework\Tests\TestCase;

class PageControllerTest extends TestCase
{
    public function testPageIndexRouteTest()
    {
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.page.index'))
            ->assertStatus(200);
    }

    public function testPageCreateRouteTest()
    {
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.page.create'))
            ->assertStatus(200);
    }

    public function testPageStoreRouteTest()
    {
        $data = ['name' => 'test page name', 'slug' => 'test-page-name', 'content' => 'test content', ''];
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->post(route('admin.page.store', $data))
            ->assertRedirect(route('admin.page.index'));

        $this->assertDatabaseHas('pages', ['name' => 'test page name']);
    }

    public function testPageEditRouteTest()
    {
        $page = Page::factory()->create();
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.page.edit', $page->id))
            ->assertStatus(200);
    }

    public function testPageUpdateRouteTest()
    {
        $page = Page::factory()->create();
        $page->name = 'updated page name';
        $data = $page->toArray();

        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->put(route('admin.page.update', $page->id), $data)
            ->assertRedirect(route('admin.page.index'));

        $this->assertDatabaseHas('pages', ['name' => 'updated page name']);
    }

    public function testPageDestroyRouteTest()
    {
        $page = Page::factory()->create();

        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->delete(route('admin.page.destroy', $page->id))
            ->assertStatus(200);

        $this->assertDatabaseMissing('pages', ['id' => $page->id]);
    }
}
