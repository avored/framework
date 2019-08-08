<?php

namespace AvoRed\Framework\Tests\Controllers;

use AvoRed\Framework\Tests\BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use AvoRed\Framework\Database\Models\Menu;
use function GuzzleHttp\json_encode;

class MenuTest extends BaseTestCase
{
    use RefreshDatabase;
    
    /* @runInSeparateProcess */
    public function testMenuIndexRouteTest()
    {
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.menu.index'))
            ->assertStatus(200)
            ->assertSee(__('avored::cms.menu.index.title'));
    }

    /* @runInSeparateProcess */
    public function testMenuCreateRouteTest()
    {
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.menu.create'))
            ->assertStatus(200)
            ->assertSee(__('avored::cms.menu.create.title'));
    }

    /* @runInSeparateProcess */
    public function testMenuStoreRouteTest()
    {
        $menuJson = json_encode([['name' => 'menu name', 'url' => '/category/slug', 'submenus' => []]]);
        dd($menuJson, 'here');
        $data = ['name' => 'meun group name', 'identifier' => 'menu-group-name', 'menu_json' => $menuJson];
        $res = $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->post(route('admin.menu.store', $data))
            ->assertRedirect(route('admin.menu.index'));
        
        $this->assertDatabaseHas('menu_groups', ['name' => 'meun group name']);
        $this->assertDatabaseHas('menus', ['name' => 'menu name', 'url' => '/category/slug']);
    }
}
