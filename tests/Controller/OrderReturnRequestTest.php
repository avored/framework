<?php

namespace AvoRed\Framework\Tests\Controller;

use AvoRed\Framework\Tests\BaseTestCase;

class OrderReturnRequestTest extends BaseTestCase
{
   /**
     * Test the Role Index Route
     * @test
     */
    public function test_order_return_request_index_route()
    {
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'admin')->get(route('admin.order-return-request.index'));
        
        $response->assertStatus(200);
    }
}
