<?php
namespace AvoRed\Framework\Tests\Feature;

use AvoRed\Framework\Database\Contracts\AdminUserModelInterface;
use AvoRed\Framework\Tests\TestCase;
class LoginControllerTest extends TestCase
{
    /**
     * Test To check if login show form is working.
     * @return void
     */
    public function test_login_page_show_form()
    {
        $response = $this->get(route('admin.login'));

        $response->assertStatus(200);
    }

    public function test_find_admin_user_by_email()
    {
        $this->createAdminUser(['is_super_admin' => 1]);

        $repository = app(AdminUserModelInterface::class);

        $data = $repository->findByEmail($this->user->email);
        $this->assertEquals($this->user->email, $data->email);
    }

    /**
     * Test To check if login post form is working.
     * @return void
     */
    public function test_login_page_post_form()
    {
        $password = 'phpunittest';
        $this->createAdminUser(['is_super_admin' => 1, 'password' => $password])
            ->actingAs($this->user, 'admin')
            ->post(route('admin.login.post', ['email' => $this->user->email, 'password' => $password]))
            ->assertRedirect(route('admin.dashboard'));

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
