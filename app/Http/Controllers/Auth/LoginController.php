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
    protected $redirectTo = '/';

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
        // If the hidden input "booked" is different than 0 then the user is redirect to the next process
        if($request->input('booked'))
        {
           return  $this->redirectTo = "/signDocument/".$request->input('email')."/".$request->input('booked')."/";
        }
        return $this->redirectTo = '/signDocument/'.$request->input('email').'/';
    }
}
