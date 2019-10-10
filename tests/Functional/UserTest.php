<?php

namespace AvoRed\Framework\Tests\Functional;

use AvoRed\Framework\Tests\BaseTestCase;
use AvoRed\Framework\System\Controllers\LoginController;

/** @runInSeparateProcess */
class UserTest extends BaseTestCase
{
    public function testRedirectPathForLoginController()
    {
        $loginController = app(LoginController::class);
        $adminPath = config('avored.admin_url');
        $this->assertEquals($loginController->redirectPath(), $adminPath);
    }
}
