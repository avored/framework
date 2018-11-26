<?php

namespace AvoRed\Framework\Tests\Controller;

use AvoRed\Framework\Tests\BaseTestCase;

class OrderTest extends BaseTestCase
{
   /**
     * Test the Role Index Route
     * @test
     */
    public function test_order_index_route()
    {
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'admin')->get(route('admin.order.index'));
        
        $response->assertStatus(200);
    }
}
