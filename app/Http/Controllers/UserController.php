<?php

namespace App\Http\Controllers;

use App\User;
use App\Drivers;
use App\Booking;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\Session; 
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $userId = Auth::user()->id;
        return $this->showUser($userId);
    }

    /**
     * Update users informations as an Admin
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function showUser($userId)
    {
        if(Auth::user()->role_id == 1|| Auth::user()->id == $userId)
        {
            $user = User::find($userId);
            $bookings = Booking::where('user_id','=',$userId)->get();
            $driver = $user->driver;
            return view('users.details')->with(compact('user','bookings','driver'));
        }
            return redirect("/profile");
    }

    /**
     * Update users informations
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function smallUpdate(Request $request)
    {
        if($request->hasFile('userPicture')){
            if($request->file('userPicture')->isValid()){
                if(Storage::disk('local')->exists($request->input('name').'.jpg'))
                {
                    Storage::delete($request->input('name').'.jpg');
                }
                $file = $request->userPicture->storeAs('public',$request->input('name').'.jpg');
            }
        }
        $user = User::find($request->input('user'));
        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
        $user->email = $request->input('email');

        $driver = $user->driver;
        $driver->address = $request->input('address');
        $driver->drivers_licence = $request->input('drivers_licence');
        $driver->licence_state = $request->input('licence_state');

        if($request->input('expiry_date') !== '')
        {
            $driver->expiry_date = date("Y-m-d",strtotime(str_replace('/','-',$request->input('expiry_date'))));
        }

        if($request->input('date_of_birth') !== '')
        {
            $driver->date_of_birth = date("Y-m-d",strtotime(str_replace('/','-',$request->input('date_of_birth'))));
        }

        $driver->save();
        $user->save();

        Session::flash('success','Your informations has been updated.');
        return redirect()->back();
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

    /**
     * Confirm a User in the database
     *
     * @param  \App\User  $user->id
     * @return \Illuminate\Http\Response
     */
    public function confirmUser($userId)
    {
        $user = User::find($userId);
        $driver = $user->driver;
        $driver->confirmed = 1;
        $driver->save();

        $bookings = $user->bookings;
        foreach ($bookings as $booking) {
            $booking->status = "Fast Check in";
            $booking->save();
        }

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
