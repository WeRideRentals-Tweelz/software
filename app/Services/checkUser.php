<?php 
namespace App\Services;

use App\Users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class CheckUser {
	private $req;

	public function __construct($req)	
	{
		$this->req = $req;
	}

	public function check()
	{
	        // The user needs to login or create an account
	        // The request is flashed for further use in /login , /register or /booking
	        $request = $this->req;
	        $request->flash();
	        if(Auth::check())
	        {
	            // The user is logged in
	            // -> Send request to bookingcontroller@store
	        	return Redirect::action('BookingController@store', $request);
	        }
	        else
	        {
	        	// --> redirect to /login or /register and use email and name flashed data to ease user experience
	            // /login and /register must use {{  old(inputname) }} to retrieve flashed data
	        	if(User::where('email','=',$request->input('email'))
	        	{
	        		// Redirect to /login
	        		Session::flash('loginMessage','Please log in before booking');
	        		return redirect('/login');
	        	}
	        	else
	        	{
	        		// Redirect to /register
	        		return redirect('/register');
	        	}

	            // The rest of the request will be used in a hidden form
	            // If the data is detected when sending the form, the controller will be BookingController@store
	            // Else it will login the user has it does normally
	        }
	}
} 
