<?php

namespace AvoRed\Framework\Tests\Controllers;

use AvoRed\Framework\Tests\BaseTestCase;

class AvoRedAssetsTest extends BaseTestCase
{
    public function testAdminScriptAvoRedJsRouteTest()
    {
        $this->get(route('admin.script', 'avored.avored.js'))
            ->assertStatus(200);
    }
    public function testAdminScriptAppJsRouteTest()
    {
        $this->get(route('admin.script', 'avored.app.js'))
            ->assertStatus(200);
    }
    public function testAdminStylesAppRouteTest()
    {
        $this->get(route('admin.styles', 'avored.app.css'))
            ->assertStatus(200);
    }
}
