<?php

namespace AvoRed\Framework\Tests\Controllers;

use AvoRed\Framework\Tests\BaseTestCase;
use AvoRed\Framework\Database\Models\Country;
use AvoRed\Framework\Database\Models\TaxRate;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaxRateTest extends BaseTestCase
{
    use RefreshDatabase;

    /* @runInSeparateProcess */
    public function testTaxRateIndexRouteTest()
    {
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.tax-rate.index'))
            ->assertStatus(200)
            ->assertSee(__('avored::system.tax-rate.index.title'));
    }

    /* @runInSeparateProcess */
    public function testTaxRateCreateRouteTest()
    {
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.tax-rate.create'))
            ->assertStatus(200)
            ->assertSee(__('avored::system.tax-rate.create.title'));
    }

    /* @runInSeparateProcess */
    public function testTaxRateStoreRouteTest()
    {
        $country = factory(Country::class)->create();
        $data = [
            'name' => 'test tax-rate name',
            'rate' => 1,
            'country_id' => $country->id,
            'postcode' => 7958,
            'rate_type' => 'PERCENTAGE',
        ];
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->post(route('admin.tax-rate.store', $data))
            ->assertRedirect(route('admin.tax-rate.index'));

        $this->assertDatabaseHas('tax_rates', ['name' => 'test tax-rate name']);
    }

    /* @runInSeparateProcess */
    public function testTaxRateEditRouteTest()
    {
        $country = factory(Country::class)->create();
        $taxRate = factory(TaxRate::class)->create(['country_id' => $country->id]);

        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.tax-rate.edit', $taxRate->id))
            ->assertStatus(200)
            ->assertSee(__('avored::system.tax-rate.edit.title'));
    }

    /* @runInSeparateProcess */
    public function testTaxRateUpdateRouteTest()
    {
        $country = factory(Country::class)->create();
        $taxRate = factory(TaxRate::class)->create(['country_id' => $country->id]);
        $taxRate->name = 'updated tax-rate name';
        $data = $taxRate->toArray();

        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->put(route('admin.tax-rate.update', $taxRate->id), $data)
            ->assertRedirect(route('admin.tax-rate.index'));

        $this->assertDatabaseHas('tax_rates', ['name' => 'updated tax-rate name']);
    }

    /* @runInSeparateProcess */
    public function testTaxRateDestroyRouteTest()
    {
        $country = factory(Country::class)->create();
        $taxRate = factory(TaxRate::class)->create(['country_id' => $country->id]);

        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->delete(route('admin.tax-rate.destroy', $taxRate->id))
            ->assertStatus(200);

        $this->assertDatabaseMissing('tax_rates', ['id' => $taxRate->id]);
    }
}
