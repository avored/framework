<?php

namespace AvoRed\Framework\Database\Factories;

use AvoRed\Framework\Database\Models\Address;
use AvoRed\Framework\Database\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class AddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Address::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $customer = Customer::factory()->create();
        $types = [
            'SHIPPING',
            'BILLING'
        ];
        $country = DB::table('countries')->get()->random();

        return [
            'type' => $types[rand(0, 1)],
            'customer_id' => $customer->id,
            'company_name' => $this->faker->company(),
            'first_name'  => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'address1'  => $this->faker->streetSuffix . $this->faker->streetName(),
            'postcode' => $this->faker->postcode(),
            'city' => $this->faker->city(),
            'state' => $this->faker->stateAbbr(),
            'country_id' => $country->id,
            'phone' => $this->faker->phoneNumber(),
        ];
    }
}
