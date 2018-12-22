<?php

namespace AvoRed\Framework\User\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use AvoRed\Framework\System\Controllers\Controller;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin.guest', ['except' => 'logout']);
    }

    /**
     * Show the AvoRed Login Form to the User.
     *
     * @return \Illuminate\View\View
     */
    public function loginForm()
    {
        return view('avored-framework::user.auth.login');
    }

    /**
     * Using an Admin Guard for the Admin Auth.
     *
     * @return \Illuminate\Auth\SessionGuard
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }

    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('avored-framework::lang.failed')],
        ]);
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect()->route('admin.login');
    }

    /**
     * Redirect Path after login and logout.
     *
     * @return string
     */
    public function redirectPath()
    {
        return  config('avored-framework.admin_url');
    }
}
