<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Login para utilizar con la API
     */
    public function loginApi()
    {
        $this->validateLogin(Request());

        if ($this->attemptLogin(Request())) {
            $user = Request()->user();
            $new_token = $user->updateToken();

            return response()->json([
                'token' => $new_token,
                'error' => false
            ]);
        }

        //return $this->sendFailedLoginResponse(Request());
        return response()->json([
            'error' => true,
            'msn_error' => 'Datos incorrectos'
        ]);
    }

    /**
     * Logout para utilizar con la API
     */
    public function logoutApi()
    {
        if ($response = $this->loggedOut(Request())) {
            $user = Request()->user();
            $user->updateToken();

            return $response;
        }

        return response()->json([
            'msn_error' => 'ERROR INTERNO'
        ]);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
