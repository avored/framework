<?php
namespace AvoRed\Framework\Tests\Feature;

use AvoRed\Framework\Database\Contracts\AdminUserModelInterface;
use AvoRed\Framework\Tests\TestCase;

class LoginControllerTest extends TestCase
{
    /** @test */
    public function test_login_page_show_form()
    {
        $response = $this->get(route('admin.login'));

        $response->assertStatus(200);
    }

    /** @test */
    public function test_find_admin_user_by_email()
    {
        $this->createAdminUser(['is_super_admin' => 1]);

        $repository = app(AdminUserModelInterface::class);

        $data = $repository->findByEmail($this->user->email);
        $this->assertEquals($this->user->email, $data->email);
    }

    /** @test */
    public function test_login_page_post_form()
    {
        $password = 'phpunittest';
        $this->createAdminUser(['is_super_admin' => 1, 'password' => $password])
            ->actingAs($this->user, 'admin')
            ->post(route('admin.login.post', ['email' => $this->user->email, 'password' => $password]))
            ->assertRedirect(route('admin.dashboard'));
    }

    /** @test */
    public function test_admin_logout_route_test()
    {
        $this
            ->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->post(route('admin.logout'))
            ->assertRedirect(route('admin.login'));
    }

    /** @test */
    public function test_admin_login_redirect_guest_middleware()
    {
        $this->createAdminUser()
            ->actingAs($this->user, 'admin')
            ->get(route('admin.login'))
            ->assertRedirect(route('admin.dashboard'));
    }

    /** @test */
    public function test_admin_login_post_route()
    {
        $password = 'phpunittest';
        $this->createAdminUser(['is_super_admin' => 1, 'password' => $password])
            ->actingAs($this->user, 'admin')
            ->post(route('admin.login.post', ['email' => $this->user->email, 'password' => $password]))
            ->assertRedirect(route('admin.dashboard'));
    }

    /** @test */
    public function test_admin_login_post_route_failed()
    {
        $password = 'phpunittest';
        $this
            ->createAdminUser(['is_super_admin' => 1, 'password' => $password])
            ->post(route('admin.login.post', ['email' => $this->user->email, 'password' => 'wrongpassword']))
            ->assertSessionHasErrors('email');
    }

    /** @test */
    public function test_guest_user_is_redirected_to_login()
    {
        $this->get(route('admin.dashboard'))
        ->assertRedirect(route('admin.login'));
    }
}
