<?php

namespace ApiVue\Http\Controllers\Auth;

use ApiVue\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Lang;
use Illuminate\Validation\ValidationException;
use Str;


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
//    use ThrottlesLogins;


    protected $maxAttempts = 3; // Default is 5
    protected $decayMinutes = 1; // Default is 1


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function accessToken(Request $request){

        $this->validateLogin($request);

        $credentials = $this->credentials($request);

        if($token = \Auth::guard('api')->attempt($credentials)){
            return $this->sendLoginResponse($request,$token);
        }

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    protected function sendLoginResponse(Request $request, $token)
    {
        $this->clearLoginAttempts($request);
        return response()->json([
            'token' => $token
        ]);
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        return response()->json([
            'error' => \Lang::get('auth.failed')
        ], 400);
    }

    protected function sendLockoutResponse(Request $request)
    {
        $seconds = $this->limiter()->availableIn(
            $this->throttleKey($request)
        );

        $message = Lang::get('auth.throttle', ['seconds' => $seconds]);

        return response()->json([
            'error' => $message
        ], 403);
    }

    public function logout(Request $request)
    {
        \Auth::guard('api')->logout();
        return response()->json([
        ], 204);
    }

    public function refreshToken(Request $request){
        $token = \Auth::guard('api')->refresh();
        return $this->sendLoginResponse($request, $token);
    }

}
