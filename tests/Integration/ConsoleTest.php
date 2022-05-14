<?php

namespace AvoRed\Framework\Tests\Integration;

use AvoRed\Framework\Tests\AvoRedBaseTestCase;

class ConsoleTest extends AvoRedBaseTestCase
{
    public function test_console_command()
    {
        $this->artisan('avored:install')
            ->expectsQuestion('Would you like to install Dummy Data?', 'Yes')
            ->assertExitCode(0);
    }
}
