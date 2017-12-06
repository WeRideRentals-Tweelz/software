<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\User;
use App\Drivers;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = "/";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->redirectUser($request);
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'phone' =>  'required|digits:10',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name'      => $data['name'],
            'surname'   => $data['surname'],
            'email'     => $data['email'],
            'phone'     => $data['phone'],
            'password'  => bcrypt($data['password']),
            'banned'    => 0,
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  User
     * @return Driver
     */
    protected function createDriver($user)
    {
        return Drivers::create([
            'user_id'   =>  $user->id,
        ]);
    }
    // If the user made a booking before registering, he will be redirected to confirm its booking
    protected function redirectUser(Request $request)
    {
        // If the hidden input "booked" is different than 0 then the user is redirect to the next process
        if($request->input('booked'))
        {
            return $this->redirectTo = "/signDocument/".$request->input('email')."/".$request->input('booked')."/";
        }
        return $this->redirectTo = '/signDocument/'.$request->input('email').'/';
    }
}
