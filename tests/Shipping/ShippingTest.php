<?php

namespace AvoRed\Framework\Tests\Shipping;

use AvoRed\Framework\Tests\BaseTestCase;
use AvoRed\Framework\Shipping\Manager;
use stdClass;

class ShippingTest extends BaseTestCase
{
   
    /** @test */
    public function test_shipping_manager_all()
    {
        $manager = new Manager();

        $manager->put('shipping_option1', new stdClass());
        $manager->put('shipping_option2', new stdClass());

        $shippingOptions = $manager->all();
        
        $this->assertCount(2, $shippingOptions);
    }

    /** @test */
    public function test_shipping_manager_get()
    {
        $manager = new Manager();
        $manager->put('shipping_option1', new stdClass());    
        $shippingOption = $manager->get('shipping_option1');
        
        $this->assertInstanceOf(stdClass::class, $shippingOption);
    }

}
