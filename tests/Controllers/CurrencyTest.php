<?php

namespace AvoRed\Framework\Tests\Controllers;

use AvoRed\Framework\Tests\BaseTestCase;
use AvoRed\Framework\Database\Models\Country;
use AvoRed\Framework\Database\Models\Currency;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CurrencyTest extends BaseTestCase
{
    use RefreshDatabase;

    public function testCurrencyIndexRouteTest()
    {
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.currency.index'))
            ->assertStatus(200);
    }

    public function testCurrencyCreateRouteTest()
    {
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.currency.create'))
            ->assertStatus(200);
    }

    public function testCurrencyStoreRouteTest()
    {
        $country = factory(Country::class)->create();
        $data = [
            'name' => 'test currency name',
            'code' => $country->currency_code,
            'symbol' => $country->currency_symbol,
            'conversation_rate' => 1,
            'status' => 'ENABLED',
        ];

        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->post(route('admin.currency.store', $data))
            ->assertRedirect(route('admin.currency.index'));

        $this->assertDatabaseHas('currencies', ['name' => 'test currency name']);
    }

    public function testCurrencyEditRouteTest()
    {
        $currency = factory(Currency::class)->create();
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.currency.edit', $currency->id))
            ->assertStatus(200);
    }

    public function testCurrencyUpdateRouteTest()
    {
        $currency = factory(Currency::class)->create();

        $currency->name = 'updated currency name';
        $data = $currency->toArray();

        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->put(route('admin.currency.update', $currency->id), $data)
            ->assertRedirect(route('admin.currency.index'));

        $this->assertDatabaseHas('currencies', ['name' => 'updated currency name']);
    }

    public function testCurrencyDestroyRouteTest()
    {
        $currency = factory(Currency::class)->create();

        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->delete(route('admin.currency.destroy', $currency->id))
            ->assertStatus(200);

        $this->assertDatabaseMissing('currencies', ['id' => $currency->id]);
    }
}
