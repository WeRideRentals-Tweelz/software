<?php

namespace App\Http\Controllers\Auth;

use App\Users;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
    protected $redirectTo = '/profile';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->redirectUser($request);
        $this->middleware('guest', ['except' => 'logout']);
    }

    // If the user made a booking before login in, he will be redirected to confirm its booking
    protected function redirectUser(Request $request)
    {
       if($request->input('quote') != '0'){
            return $this->redirectTo = '/quote/'.$request->input('quote').'/confirmation';
       }
       return $this->redirectTo = '/profile';
    }
}
