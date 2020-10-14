<?php

use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{ 
    protected $format_price;

    public function setUp() : void
    {
       $this->format_price = new AvoRed\Framework\Database\Models\Product;
    }
    public function test_format_price()
    {
        $format_price = 0.00;

        $this->assertEquals($format_price, $this->format_price->getPrice($format_price));
    }
}