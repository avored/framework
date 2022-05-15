<?php

namespace AvoRed\Framework\Tests\UnitTests;

use AvoRed\Framework\Database\Contracts\RoleModelInterface;
use AvoRed\Framework\Database\Models\Role;
use AvoRed\Framework\Tests\AvoRedBaseTestCase;

class RoleRepositoryTest extends AvoRedBaseTestCase
{
    public function test_find_admin_role_method()
    {
        $role = Role::factory()->create(['name' => Role::ADMIN]);
        $this->assertEquals(Role::ADMIN, $role->name);
    }

    public function test_role_option_method()
    {
        Role::factory(2)->create();
        $options = app(RoleModelInterface::class)->options();
        $this->assertEquals(2, $options->count());
    }
}
