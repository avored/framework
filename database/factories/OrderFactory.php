<?php

namespace AvoRed\Framework\Database\Factories;

use AvoRed\Framework\Database\Models\Order;
use AvoRed\Framework\Database\Models\Address;
use AvoRed\Framework\Database\Models\Customer;
use AvoRed\Framework\Database\Models\OrderStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $shippingAddress = Address::factory()->create(['type' => 'SHIPPING']);
        $billingAddress = Address::factory()->create(['type' => 'BILLING']);
        $customer = Customer::factory()->create();
        $orderStatus = OrderStatus::factory()->create();
        return [
            'shipping_option' => $this->faker->word,
            'payment_option' => $this->faker->word,
            'customer_id' => $customer->id,
            'order_status_id' => $orderStatus->id,
            'shipping_address_id' => $shippingAddress->id,
            'billing_address_id' => $billingAddress->id,
            'track_code' => rand(100000, 9999999),
        ];
    }
}
