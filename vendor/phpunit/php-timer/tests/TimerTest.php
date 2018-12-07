<?php
/*
 * This file is part of phpunit/php-timer.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SebastianBergmann\Timer;

use PHPUnit\Framework\TestCase;

/**
 * @covers \SebastianBergmann\Timer\Timer
 */
class TimerTest extends TestCase
{
    public function testStartStop(): void
    {
        $this->assertInternalType('float', Timer::stop());
    }

    /**
     * @dataProvider secondsProvider
     */
    public function testSecondsToTimeString(string $string, string $seconds): void
    {
        $this->assertEquals(
            $string,
            Timer::secondsToTimeString($seconds)
        );
    }

    public function testTimeSinceStartOfRequest(): void
    {
        $this->assertStringMatchesFormat(
            '%f %s',
            Timer::timeSinceStartOfRequest()
        );
    }

    public function testTimeSinceStartOfRequest2(): void
    {
        if (isset($_SERVER['REQUEST_TIME_FLOAT'])) {
            unset($_SERVER['REQUEST_TIME_FLOAT']);
        }

        $this->assertStringMatchesFormat(
            '%f %s',
            Timer::timeSinceStartOfRequest()
        );
    }

    /**
     * @backupGlobals     enabled
     */
    public function testTimeSinceStartOfRequest3(): void
    {
        if (isset($_SERVER['REQUEST_TIME_FLOAT'])) {
            unset($_SERVER['REQUEST_TIME_FLOAT']);
        }

        if (isset($_SERVER['REQUEST_TIME'])) {
            unset($_SERVER['REQUEST_TIME']);
        }

        $this->expectException(RuntimeException::class);

        Timer::timeSinceStartOfRequest();
    }

    public function testResourceUsage(): void
    {
        $this->assertStringMatchesFormat(
            'Time: %s, Memory: %fMB',
            Timer::resourceUsage()
        );
    }

    public function secondsProvider()
    {
        return [
            ['0 ms', 0],
            ['1 ms', .001],
            ['10 ms', .01],
            ['100 ms', .1],
            ['999 ms', .999],
            ['1 second', .9999],
            ['1 second', 1],
            ['2 seconds', 2],
            ['59.9 seconds', 59.9],
            ['59.99 seconds', 59.99],
            ['59.99 seconds', 59.999],
            ['1 minute', 59.9999],
            ['59 seconds', 59.001],
            ['59.01 seconds', 59.01],
            ['1 minute', 60],
            ['1.01 minutes', 61],
            ['2 minutes', 120],
            ['2.01 minutes', 121],
            ['59.99 minutes', 3599.9],
            ['59.99 minutes', 3599.99],
            ['59.99 minutes', 3599.999],
            ['1 hour', 3599.9999],
            ['59.98 minutes', 3599.001],
            ['59.98 minutes', 3599.01],
            ['1 hour', 3600],
            ['1 hour', 3601],
            ['1 hour', 3601.9],
            ['1 hour', 3601.99],
            ['1 hour', 3601.999],
            ['1 hour', 3601.9999],
            ['1.01 hours', 3659.9999],
            ['1.01 hours', 3659.001],
            ['1.01 hours', 3659.01],
            ['2 hours', 7199.9999],
        ];
    }
}
