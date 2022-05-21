<?php

namespace AvoRed\Framework\Tests\Integration;

use AvoRed\Framework\Database\Models\Role;
use AvoRed\Framework\Tests\TestCase;

class ConsoleTest extends TestCase
{
    public function test_console_avored_install_command()
    {
        $this->artisan('avored:install')
            ->expectsQuestion('Would you like to install Dummy Data?', 'no')
            ->expectsQuestion('What is your First Name?', 'admin')
            ->expectsQuestion('What is your last Name?', 'admin')
            ->expectsQuestion('What is your Email Address?', 'admin@admin.com')
            ->expectsQuestion('What is your Password?', 'password')
            ->expectsQuestion('Confirm your password again?', 'password')
            ->assertExitCode(0);
    }

    public function test_console_avored_admin_make_command()
    {
        Role::factory()->create(['name' => Role::ADMIN]);
        $this->artisan('avored:admin:make')
            ->expectsQuestion('What is your First Name?', 'admin')
            ->expectsQuestion('What is your last Name?', 'admin')
            ->expectsQuestion('What is your Email Address?', 'admin@admin.com')
            ->expectsQuestion('What is your Password?', 'password')
            ->expectsQuestion('Confirm your password again?', 'password')
            ->assertExitCode(0);
    }
}
