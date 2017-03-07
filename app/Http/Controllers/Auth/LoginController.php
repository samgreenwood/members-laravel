<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'username';
    }


    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        $success = $this->guard()->attempt(
            $this->credentials($request), $request->has('remember')
        );

        if($success) return $success;

        if($this->isLegacyAuthentication()) {
            User::where('username', $request->input('username'))->update([
                'password' => bcrypt($request->input('password'))
            ]);

            return true;
        }

        return false;
    }

    /**
     * @return mixed
     */
    protected function isLegacyAuthentication()
    {
        $user = User::where('username', request('username'))->first();

        if(!$user) return false;

        $raw = request('password');
        $encoded = crypt($raw, null);
        $salt = substr($encoded, 0, 12);
        $legacy = crypt($raw, $salt);

        return $user->password == $legacy;
    }
}
