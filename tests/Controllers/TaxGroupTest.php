<?php

namespace AvoRed\Framework\Tests\Controllers;

use AvoRed\Framework\Tests\BaseTestCase;
use AvoRed\Framework\Database\Models\TaxGroup;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaxGroupTest extends BaseTestCase
{
    use RefreshDatabase;

    public function testTaxGroupIndexRouteTest()
    {
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.tax-group.index'))
            ->assertStatus(200)
            ->assertSee(__('avored::system.tax-group.index.title'));
    }

    public function testTaxGroupCreateRouteTest()
    {
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.tax-group.create'))
            ->assertStatus(200)
            ->assertSee(__('avored::system.tax-group.create.title'));
    }

    public function testTaxGroupStoreRouteTest()
    {
        $data = ['name' => 'test tax-group name'];
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->post(route('admin.tax-group.store', $data))
            ->assertRedirect(route('admin.tax-group.index'));

        $this->assertDatabaseHas('tax_groups', ['name' => 'test tax-group name']);
    }

    public function testTaxGroupEditRouteTest()
    {
        $userGroup = factory(TaxGroup::class)->create();
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.tax-group.edit', $userGroup->id))
            ->assertStatus(200)
            ->assertSee(__('avored::system.tax-group.edit.title'));
    }

    public function testTaxGroupUpdateRouteTest()
    {
        $userGroup = factory(TaxGroup::class)->create();
        $userGroup->name = 'updated tax-group name';
        $data = $userGroup->toArray();

        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->put(route('admin.tax-group.update', $userGroup->id), $data)
            ->assertRedirect(route('admin.tax-group.index'));

        $this->assertDatabaseHas('tax_groups', ['name' => 'updated tax-group name']);
    }

    public function testTaxGroupDestroyRouteTest()
    {
        $userGroup = factory(TaxGroup::class)->create();

        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->delete(route('admin.tax-group.destroy', $userGroup->id))
            ->assertStatus(200);

        $this->assertDatabaseMissing('tax_groups', ['id' => $userGroup->id]);
    }
}
