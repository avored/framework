<?php
namespace AvoRed\Framework\User\Controllers;

use AvoRed\Framework\User\Requests\AdminLoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class LoginController extends Controller
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
    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin.guest')->except('logout');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  AdminLoginRequest  $request
     * @return RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(AdminLoginRequest $request)
    {
        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param AdminLoginRequest $request
     * @return RedirectResponse
     */
    protected function sendLoginResponse(AdminLoginRequest $request): RedirectResponse
    {
        $request->session()->regenerate();

        return redirect()->intended($this->redirectPath());
    }


    public function redirectPath()
    {
        return route('admin.dashboard');
    }
    /**
     * Attempt to log the user into the application.
     *
     * @param AdminLoginRequest $request
     * @return bool
     */
    protected function attemptLogin(AdminLoginRequest $request)
    {
        return $this->guard()->attempt(
            $request->only('email', 'password'),
            $request->filled('remember')
        );
    }


    /**
     * Show the AvoRed Login Form to the User.
     * @return \Illuminate\View\View
     */
    public function loginForm(): View
    {
        return view('avored::user.auth.login-form');
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
     * @param  AdminLoginRequest $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws ValidationException
     */
    protected function sendFailedLoginResponse(AdminLoginRequest $request)
    {
        throw ValidationException::withMessages(
            ['email' => [trans('avored::system.failed')]]
        );
    }

    /**
     * Redirect Path after login and logout.
     * @param Request $request
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
