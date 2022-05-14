<?php

namespace AvoRed\Framework\Tests;

class ExampleTest extends AvoRedBaseTestCase
{
    public function test_the_application_returns_a_successful_response()
    {
        $this->assertTrue(true);
    }

    public function test_console_command()
    {
        $this->artisan('avored:install')
            ->expectsQuestion('Would you like to install Dummy Data?', 'Yes')
            ->assertExitCode(0);
    }
}