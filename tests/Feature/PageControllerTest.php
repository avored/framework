<?php

namespace AvoRed\Framework\Tests\Feature;

use AvoRed\Framework\Database\Models\Page;
use AvoRed\Framework\Tests\TestCase;

class PageControllerTest extends TestCase
{
    
    /** @test */
    public function test_page_index_route()
    {
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.page.index'))
            ->assertStatus(200);
    }

    /** @test */
    public function test_page_create_route()
    {
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.page.create'))
            ->assertStatus(200);
    }

    /** @test */
    public function test_page_store_route()
    {
        $data = ['name' => 'test page name', 'slug' => 'test-page-name', 'content' => 'test content', ''];
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->post(route('admin.page.store', $data))
            ->assertRedirect(route('admin.page.index'));

        $this->assertDatabaseHas('pages', ['name' => 'test page name']);
    }

    /** @test */
    public function test_pageedit_route_test()
    {
        $page = Page::factory()->create();
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.page.edit', $page->id))
            ->assertStatus(200);
    }

    /** @test */
    public function test_pageupdate_route()
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

    /** @test */
    public function test_page_destroy_route()
    {
        $page = Page::factory()->create();

        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->delete(route('admin.page.destroy', $page->id))
            ->assertStatus(200);

        $this->assertDatabaseMissing('pages', ['id' => $page->id]);
    }
}
