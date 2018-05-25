<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Driver;
use App\Services\UserServices;
use App\Services\DriverService;
use App\Services\DocumentServices;
use App\Services\EmailSender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session; 
use Illuminate\Support\Facades\Hash; 

class ProfileController extends Controller
{
    public function __construct(){
    	$this->middleware('auth');
    }

    public function show(){
    	$userService = new UserServices();
    	$driverService = new DriverService();

    	$user = $userService->getUserFromAuth();
    	$driver = $userService->getDriverInfo();
    	$bookings = $driverService->getDriverBookings($driver->id);
    	$document = $userService->getUserDocuments($user);

    	return view('profile.details')->with(compact('user','bookings','driver','document'));
    }

    public function update(Request $request, $userId){


        $userService = new UserServices();

        $userService->storeAvatar($request);

        $user = User::find($userId);
        $user->name     = $request->input('name');
        $user->surname  = $request->input('surname');
        $user->phone    = $request->input('phone');
        $user->email    = $request->input('email');

        $driver = $user->driver;
        $driver->address            = $request->input('address');
        $driver->city               = $request->input('city');
        $driver->state              = $request->input('state');
        $driver->postcode           = $request->input('postcode');   
        $driver->drivers_licence    = $request->input('drivers_licence');
        $driver->licence_state      = $request->input('licence_state');
        $driver->expiry_date = $userService->checkDate($request->input('expiry_date'));
        $driver->date_of_birth = $userService->checkDate($request->input('date_of_birth'));

        $driver->save();
        $user->save();

        Session::flash('success','Your informations has been updated.');
        return redirect('/profile/'.$user->id);
    }

    public function signDocument($userId){
    	$user = User::find($userId);
    	$user->signed = 1;
    	$user->save();

    	$emailService = new EmailSender($user->email);
    	$documentService = new DocumentServices();
    	$emailService->sendDocument($documentService->getTermsAndConditions());
    	return redirect('/profile');
    }

    /**
     * Update users password
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request)
    {
        $user = User::find(Auth::user()->id);
        
        //Check the given password with the hash in database 
        if(Hash::check($request->input('password'),$user->password))
        {
            $user->password = Hash::make($request->input('new_password'));
            $user->save();

            Session::flash('success','Your informations has been updated.');
            return redirect()->back();
        }

        Session::flash('passwordError','The given password is not correct.');
        return redirect()->back();
    }
}
