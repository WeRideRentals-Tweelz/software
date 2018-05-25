<?php 
namespace App\Services;

use App\User;
use App\Quote;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Cookie;

class CheckUser {
	private $req;
	private $quoteId;

	public function __construct()	
	{
		//$this->req = $req;
		//$this->quoteId = $quoteId;
	}

	public function pathToRedirectIfUserExists($email,$quote)
	{
		
        if($this->isUserLoggedIn())
        {
            // The user is logged in
            Session::flash('success','We well receive your demand ! For a faster check-in, please consider filling all your informations.');
        	return redirect('/quote/'.$quote->id.'/confirmation');
        }
        if($this->isUserExists($email))
    	{
    		// Redirect to /login
    		Session::flash('loginMessage','Please log in before booking');
    		return $path = view('auth.login');
    	}
    	else
    	{
    		Session::flash('registerMessage','Please create an account before booking');
    		// Redirect to /register
    		return $path = view('auth.register');
    	}
	}

	public function isUserLoggedIn(){
		if(Auth::check()){
			return true;
		}
		return false;
	}

	public function isUserExists($email){
		$user = User::where('email','=',$email)->first();
		if( count($user) >= 1){
			return true;
		}
		return false;
	}
} 
