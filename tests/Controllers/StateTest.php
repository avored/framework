<?php

namespace AvoRed\Framework\Tests\Controllers;

use AvoRed\Framework\Tests\BaseTestCase;
use AvoRed\Framework\Database\Models\State;
use AvoRed\Framework\Database\Models\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StateTest extends BaseTestCase
{
    use RefreshDatabase;

    /* @runInSeparateProcess */
    public function testStateIndexRouteTest()
    {
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.state.index'))
            ->assertStatus(200)
            ->assertSee(__('avored::system.state.index.title'));
    }

    /* @runInSeparateProcess */
    public function testStateCreateRouteTest()
    {
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.state.create'))
            ->assertStatus(200)
            ->assertSee(__('avored::system.state.create.title'));
    }

    /* @runInSeparateProcess */
    public function testStateStoreRouteTest()
    {
        $country = factory(Country::class)->create();
        $data = ['name' => 'test state name', 'code' => 'state_code', 'country_id' => $country->id];
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->post(route('admin.state.store', $data))
            ->assertRedirect(route('admin.state.index'));

        $this->assertDatabaseHas('states', ['name' => 'test state name']);
    }

    /* @runInSeparateProcess */
    public function testStateEditRouteTest()
    {
        $country = factory(Country::class)->create();
        $state = factory(State::class)->create(['country_id' => $country->id]);
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.state.edit', $state->id))
            ->assertStatus(200)
            ->assertSee(__('avored::system.state.edit.title'));
    }

    /* @runInSeparateProcess */
    public function testStateUpdateRouteTest()
    {
        $country = factory(Country::class)->create();
        $state = factory(State::class)->create(['country_id' => $country->id]);

        $state->name = 'updated state name';
        $data = $state->toArray();

        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->put(route('admin.state.update', $state->id), $data)
            ->assertRedirect(route('admin.state.index'));

        $this->assertDatabaseHas('states', ['name' => 'updated state name']);
    }

    /* @runInSeparateProcess */
    public function testStateDestroyRouteTest()
    {
        $country = factory(Country::class)->create();
        $state = factory(State::class)->create(['country_id' => $country->id]);

        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->delete(route('admin.state.destroy', $state->id))
            ->assertStatus(200);

        $this->assertDatabaseMissing('states', ['id' => $state->id]);
    }
}
