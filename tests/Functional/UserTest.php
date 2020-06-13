<?php

namespace AvoRed\Framework\Tests\Functional;

use AvoRed\Framework\Tests\BaseTestCase;
use AvoRed\Framework\User\Controllers\LoginController;

/** @runInSeparateProcess */
class UserTest extends BaseTestCase
{
    public function testRedirectPathForLoginController()
    {
        $loginController = app(LoginController::class);
        $adminPath = route('admin.dashboard');
        $this->assertEquals($loginController->redirectPath(), $adminPath);
    }
}
