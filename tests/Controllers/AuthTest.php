<?php

namespace AvoRed\Framework\Tests\Controllers;

use AvoRed\Framework\Tests\BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

/** @runInSeparateProcess */
class AuthTest extends BaseTestCase
{
    use RefreshDatabase;

    /* @runInSeparateProcess */
    public function testAdminLoginRouteTest()
    {
        $this->get(route('admin.login'))
            ->assertStatus(200);
    }

    /* @runInSeparateProcess */
    public function testAdminLogoutRouteTest()
    {
        $this
            ->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->post(route('admin.logout'))
            ->assertRedirect(route('admin.login'));
    }

    /* @runInSeparateProcess */
    public function testAdminLoginRedirectGuestMiddleware()
    {
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.login'))
            ->assertRedirect(route('admin.dashboard'));
    }

    /* @runInSeparateProcess */
    public function testAdminLoginPostRoute()
    {
        $password = 'phpunittest';
        $this->createAdminUser(['is_super_admin' => 1, 'password' => $password])
            ->actingAs($this->user, 'admin')
            ->post(route('admin.login.post', ['email' => $this->user->email, 'password' => $password]))
            ->assertRedirect(route('admin.dashboard'));
    }

    /* @runInSeparateProcess */
    public function testAdminLoginPostRouteFailed()
    {
        $password = 'phpunittest';
        $this
            ->createAdminUser(['is_super_admin' => 1, 'password' => $password])
            ->post(route('admin.login.post', ['email' => $this->user->email, 'password' => 'wrongpassword']))
            ->assertSessionHasErrors('email');
    }
}
