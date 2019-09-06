<?php

namespace AvoRed\Framework\System\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class LoginController extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    use AuthenticatesUsers, AuthorizesRequests;

    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin.guest')->except('logout');
    }

    /**
     * Show the AvoRed Login Form to the User.
     * @return \Illuminate\View\View
     */
    public function loginForm()
    {
        return view('avored::system.login.form');
    }

    /**
     * Using an Admin Guard for the Admin Auth.
     * @return \Illuminate\Auth\SessionGuard
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }

    /**
     * Get the failed login response instance.
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages(
            [$this->username() => [trans('avored::system.failed')]]
        );
    }

    /**
     * Redirect Path after login and logout.
     * @return string
     */
    public function redirectPath()
    {
        return config('avored.admin_url');
    }

    /**
     * Redirect Path after login and logout.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();

        return redirect()->route('admin.login');
    }
}
