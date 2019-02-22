<?php

namespace AvoRed\Framework\Tests\Controller;

use AvoRed\Framework\Tests\BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use AvoRed\Framework\Models\Database\AdminUser;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends BaseTestCase
{

    use WithFaker;
    use RefreshDatabase;

    /**
     * Test to check if admin login get controller is working
     *
     * @return void
     */
    public function testLoginGetTest()
    {
        $response = $this->get(route('admin.login'));
        $response->assertStatus(200);
        $response->assertSee('AvoRed Admin Login');
    }

    /**
     * Test to check if admin login post route is working
     *
     * @return void
     */
    public function testLoginPostTest()
    {
        $user = $this->_getAdminUser();
        $response = $this->post(route('admin.login.post'), ['email' => 'admin@admin.com', 'password' => 'admin123']);

        $response->assertRedirect(route('admin.dashboard'));
    }

    /**
     * Test to check if admin logout post route
     *
     * @return void
     */
    public function testLogoutPostTest()
    {
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'admin')->get(route('admin.logout'));

        $response->assertRedirect(route('admin.login'));
    }

    /**
     * Test to check if reset password link get route
     *
     * @return void
     */
    public function testResetPasswordGet()
    {
        $this
        ->get(route('admin.password.reset'))
        ->assertStatus(200)
        ->assertSee(__('avored-framework::user.auth.reset_password'))
        ->assertSee(__('avored-framework::user.auth.email'))
        ->assertSee(__('avored-framework::user.auth.reset_password_link'))
        ;
    }

    /**
     * Test to check if reset password link post route with invalid email
     *
     * @return void
     */
    public function testResetPasswordPostWithInvalidEmail()
    {
        $this
            ->followingRedirects()
            ->from(route('admin.password.reset'))
            ->post(route('admin.password.email.post'), [
                'email' => Str::random(),
            ])
            ->assertSee(__('validation.email', [
                'attribute' => 'email',
            ]));
    }

    /**
     * Test to check if reset password link post route
     *
     * @return void
     */
    public function testResetPasswordPost()
    {
        $user = factory(AdminUser::class)->create();
        $this
            ->followingRedirects()
            ->from(route('admin.password.reset'))
            ->post(route('admin.password.email.post'), [
                'email' => $user->email,
            ])
            ->assertSee(e(__('passwords.sent')));
    }

    /**
     * Test to check if password reset get route 
     *
     * @return void
     */
    public function testShowPasswordResetRoute()
    {
        $user = factory(AdminUser::class)->create();
        $token = Password::broker('adminusers')->createToken($user);

        $this
            ->get(route('admin.password.reset.token', ['token' => $token]))
            ->assertSee(__('avored-framework::user.auth.reset_password'))
            ->assertSee(__('avored-framework::user.auth.email'))
            ->assertSee(__('avored-framework::user.auth.password'))
            ->assertSee(__('avored-framework::user.auth.password_confirm'))
            ;
    }

    /**
     * Testing submitting the password reset page with an invalid
     * email address.
     */
    public function testShowPasswordResetRouteWithInvalidaEmail()
    {
        $user = factory(AdminUser::class)->create([
            'password' => bcrypt('test123'),
        ]);

        $token = Password::broker('adminusers')->createToken($user);

        $password = Str::random();

        $this
            ->followingRedirects()
            ->from(route('admin.password.reset.token', ['token' => $token]))
            ->post(route('admin.password.reset.post'), [
                'token' => $token,
                'email' => Str::random(),
                'password' => $password,
                'password_confirmation' => $password,
            ])
            ->assertSee(__('validation.email', [
                'attribute' => 'email',
            ]));

        $user->refresh();

        $this->assertFalse(Hash::check($password, $user->password));
        $this->assertTrue(Hash::check('test123',$user->password));
    }

    /**
     * Testing submitting the password reset page.
     */
    public function testSubmitPasswordReset()
    {
        $user = factory(AdminUser::class)->create();
        $token = Password::broker('adminusers')->createToken($user);

        $password = Str::random();
        $response = $this
            ->followingRedirects()
            ->post(route('admin.password.reset.post'), [
                'token' => $token,
                'email' => $user->email,
                'password' => $password,
                'password_confirmation' => $password,
            ])
            ->assertStatus(200);

        $user->refresh();
        $this->assertFalse(Hash::check('test123', $user->password));
        $this->assertTrue(Hash::check($password, $user->password));
    }
}
