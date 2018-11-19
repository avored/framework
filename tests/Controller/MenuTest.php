<?php

namespace AvoRed\Framework\Tests\Controller;

use AvoRed\Framework\Tests\BaseTestCase;

class MenuTest extends BaseTestCase
{
    /**
     * Test to check if menu index and store route is working
     *
     * @return void
     */
    public function testMenuRouteTest()
    {
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'admin')->get(route('admin.menu.index'));
        $response->assertStatus(200);
        $response->assertSee('Menu');

        //
        $data['name'] = 'test menu';
        $data['identifier'] = 'test-menu';
        $data['menu_json'] = '[[{
             "name": "Kitchen",
             "params": "kitchen",
             "route": "category.view",
             "children": [
              []
             ]
            }]]';
        $response = $this->post(route('admin.menu.store'), $data);

        $response->assertRedirect(route('admin.menu.index'));
    }
}
