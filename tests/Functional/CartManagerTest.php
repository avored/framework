<?php

namespace AvoRed\Framework\Tests\Functional;

use AvoRed\Framework\Cart\Manager;
use AvoRed\Framework\Database\Models\Product;
use AvoRed\Framework\Tests\BaseTestCase;

/** @runInSeparateProcess */
class CartManagerTest extends BaseTestCase
{
    public function testAddToCart()
    {
        $sessionManager = app()->get('session');
        $cartManager = new Manager($sessionManager);
        $product = factory(Product::class)->create();

        [$status, $message] = $cartManager->add($product->slug);
        
        $this->assertTrue($status);
        $this->assertEquals($message, __('avored::catalog.cart_success_notification')); 
    }

    public function testAddToCartMoreThenAvailableQty()
    {
        $sessionManager = app()->get('session');
        $cartManager = new Manager($sessionManager);
        $product = factory(Product::class)->create(['qty' => 5]);

        [$status, $message] = $cartManager->add($product->slug, 6);
        
        $this->assertFalse($status);
        $this->assertEquals($message, __('avored::system.notification.not_enough_qty')); 
    }
}
