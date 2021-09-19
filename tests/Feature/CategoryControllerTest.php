<?php

namespace AvoRed\Framework\Tests\Feature;

use AvoRed\Framework\Database\Models\Category;
use AvoRed\Framework\Tests\TestCase;

class CategoryControllerTest extends TestCase
{

    /** @test */
    public function test_category_page_index_form()
    {
        $response = $this->getAvoRed('admin.category.index');

        $response->assertStatus(200)
            ->assertViewIs('avored::catalog.category.index');
    }
    /** @test */
    public function test_category_page_create_form()
    {
        $response = $this->getAvoRed('admin.category.create');

        $response->assertStatus(200)
            ->assertViewIs('avored::catalog.category.create');
    }

    /** @test */
    public function test_category_page_store_form()
    {
        $data = Category::factory()->make();

        $response = $this->getAvoRed('admin.category.create');

        $response->assertStatus(200)
            ->assertViewIs('avored::catalog.category.create');
    }

    // public function test_find_admin_user_by_email()
    // {
    //     $this->createAdminUser(['is_super_admin' => 1]);

    //     $repository = app(AdminUserModelInterface::class);

    //     $data = $repository->findByEmail($this->user->email);
    //     $this->assertEquals($this->user->email, $data->email);
    // }

    // /**
    //  * Test To check if login post form is working.
    //  * @return void
    //  */
    // public function test_login_page_post_form()
    // {
    //     $password = 'phpunittest';
    //     $this->createAdminUser(['is_super_admin' => 1, 'password' => $password])
    //         ->actingAs($this->user, 'admin')
    //         ->post(route('admin.login.post', ['email' => $this->user->email, 'password' => $password]))
    //         ->assertRedirect(route('admin.dashboard'));
    // }

    // public function testAdminLogoutRouteTest()
    // {
    //     $this
    //         ->createAdminUser()
    //         ->actingAs($this->user, 'admin')
    //         ->post(route('admin.logout'))
    //         ->assertRedirect(route('admin.login'));
    // }

    // public function testAdminLoginRedirectGuestMiddleware()
    // {
    //     $this->createAdminUser()
    //         ->actingAs($this->user, 'admin')
    //         ->get(route('admin.login'))
    //         ->assertRedirect(route('admin.dashboard'));
    // }

    // public function testAdminLoginPostRoute()
    // {
    //     $password = 'phpunittest';
    //     $this->createAdminUser(['is_super_admin' => 1, 'password' => $password])
    //         ->actingAs($this->user, 'admin')
    //         ->post(route('admin.login.post', ['email' => $this->user->email, 'password' => $password]))
    //         ->assertRedirect(route('admin.dashboard'));
    // }

    // public function testAdminLoginPostRouteFailed()
    // {
    //     $password = 'phpunittest';
    //     $this
    //         ->createAdminUser(['is_super_admin' => 1, 'password' => $password])
    //         ->post(route('admin.login.post', ['email' => $this->user->email, 'password' => 'wrongpassword']))
    //         ->assertSessionHasErrors('email');
    // }

    // public function testGuestUserIsRedirectedToLogin()
    // {
    //     $this->get(route('admin.dashboard'))
    //         ->assertRedirect(route('admin.login'));
    // }
}
