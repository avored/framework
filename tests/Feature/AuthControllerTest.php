<?php

namespace AvoRed\Framework\Tests\Feature;

use AvoRed\Framework\Tests\TestCase;

class AuthControllerTest extends TestCase
{
    /** @test */
    public function test_admin_login_route_test()
    {
        $this->get(route('admin.login'))
        ->assertStatus(200)
            ->assertViewIs('avored::user.auth.login-form');
    }

    public function testAdminLogoutRouteTest()
    {
        $this
            ->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->post(route('admin.logout'))
            ->assertRedirect(route('admin.login'));
    }

    public function testAdminLoginRedirectGuestMiddleware()
    {
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.login'))
            ->assertRedirect(route('admin.dashboard'));
    }

    public function testAdminLoginPostRoute()
    {
        $password = 'phpunittest';
        $this->createAdminUser(['is_super_admin' => 1, 'password' => $password])
            ->actingAs($this->user, 'admin')
            ->post(route('admin.login.post', ['email' => $this->user->email, 'password' => $password]))
            ->assertRedirect(route('admin.dashboard'));
    }

    public function testAdminLoginPostRouteFailed()
    {
        $password = 'phpunittest';
        $this
            ->createAdminUser(['is_super_admin' => 1, 'password' => $password])
            ->post(route('admin.login.post', ['email' => $this->user->email, 'password' => 'wrongpassword']))
            ->assertSessionHasErrors('email');
    }

    public function testGuestUserIsRedirectedToLogin()
    {
        $this->get(route('admin.dashboard'))
        ->assertRedirect(route('admin.login'));
    }
}
