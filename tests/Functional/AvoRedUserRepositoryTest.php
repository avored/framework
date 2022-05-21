<?php

namespace AvoRed\Framework\Tests\UnitTests;

use AvoRed\Framework\Database\Contracts\AdminUserModelInterface;
use AvoRed\Framework\Database\Models\AdminUser;
use AvoRed\Framework\Tests\TestCase;

class AdminUserRepositoryTest extends TestCase
{
    public function test_find_by_email_admin_user_method()
    {
        AdminUser::factory()->create(['email' => 'unittest@example.com']);
        $adminUser = app(AdminUserModelInterface::class)->findByEmail('unittest@example.com');
        $this->assertEquals('unittest@example.com', $adminUser->email);
    }
}
