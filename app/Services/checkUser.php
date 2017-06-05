<?php 
namespace App\Services;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Cookie;

class CheckUser {
	private $req;
	private $bookingId;

	public function __construct($req,$bookingId)	
	{
		$this->req = $req;
		$this->bookingId = $bookingId;
	}

	public function check()
	{
	        // The user needs to login or create an account
	        $request = $this->req;
	        $request->flash();

	        $bookingId = $this->bookingId;

	        if(Auth::check())
	        {
	            // The user is logged in
	            // -> Send request to bookingcontroller@store
	            Session::flash('success','We well receive your demand ! For a faster check-in, please login');
	        	return $path = redirect("/bookings/confirm/".$bookingId."/".$request->input('email'));
	        }
	        else
	        {
	        	// Create a first booking object without all information required.
	        	// This booking object will be retrieve when user log in or register

	        	// --> redirect to /login or /register and use email and name flashed data to ease user experience
	            // /login and /register must use {{  old(inputname) }} to retrieve flashed data
	            $user = User::where('email','=',$request->input('email'))->first();
	            
	        	if( count($user) >= 1 )
	        	{
	        		// Redirect to /login
	        		Session::flash('loginMessage','Please log in before booking');
	        		return $path = view('auth.login')->with(compact('bookingId'));
	        	}
	        	else
	        	{
	        		Session::flash('registerMessage','Please create an account in before booking');
	        		// Redirect to /register
	        		return $path = view('auth.register')->with(compact('bookingId'));
	        	}

	            // The rest of the request will be used in a hidden form
	            // If the data is detected when sending the form, the controller will be BookingController@store
	            // Else it will login the user has it does normally
	        }
	}
} 
