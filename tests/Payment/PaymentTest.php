<?php

namespace AvoRed\Framework\Tests\Payment;

use AvoRed\Framework\Tests\BaseTestCase;
use AvoRed\Framework\Payment\Manager;
use stdClass;

class PaymentTest extends BaseTestCase
{
   
    /** @test */
    public function test_payment_manager_all()
    {
        $manager = new Manager();

        $manager->put('payment_option1', new stdClass());
        $manager->put('payment_option2', new stdClass());

        $paymentOptions = $manager->all();
        
        $this->assertCount(2, $paymentOptions);
    }

    /** @test */
    public function test_payment_manager_get()
    {
        $manager = new Manager();
        $manager->put('payment_option1', new stdClass());    
        $paymentOption = $manager->get('payment_option1');
        
        $this->assertInstanceOf(stdClass::class, $paymentOption);
    }

}
