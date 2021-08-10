<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected function username(){
        return "phone";
    }

    protected function redirectTo()
    {

        if (Auth::user()->is_admin) {
            return route("admin");
        }

        if (Auth::user()->is_attract) {
            return route("attract");
        }
        if (Auth::user()->is_circulation) {
            return route("circulation");
        }
    }

    public function showLoginForm()
    {
        if (Auth::check()){

            if (Auth::user()->is_admin) {
                return route("admin");
            }

            if (Auth::user()->is_attract) {
                return route("attract");
            }
            if (Auth::user()->is_circulation) {
                return route("circulation");
            }
        }
        return view('auth.login');

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
