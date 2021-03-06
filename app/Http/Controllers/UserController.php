<?php

namespace App\Http\Controllers;

use App\User;
use App\Documents;
use App\Drivers;
use App\Booking;

use App\Services\UserServices;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\Session; 
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Illuminate\Contracts\Routing\ResponseFactory;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('show','showUser');
        $this->middleware('admin')->except('show','showUser','smallUpdate','changePassword');
        $this->middleware('adminOrAuth')->only('smallUpdate','changePassword');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userServices = new UserServices();
        $users = User::where('banned','=',0)->orderBy('name','ASC')->paginate(10);
        return view('users.index')->with(compact('users','userServices'));
    }

    public function indexBanned()
    {
        $users = User::where('banned','=',1)->get();
        return view('users.index')->with(compact('users'));
    }

    public function export()
    {
        $headers = [
                'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0'
            ,   'Content-type'        => 'text/csv'
            ,   'Content-Disposition' => 'attachment; filename=WeRide-Users.csv'
            ,   'Expires'             => '0'
            ,   'Pragma'              => 'public'
        ];

        $list = User::all()->toArray();

        # add headers for each column in the CSV download
        array_unshift($list, array_keys($list[0]));

       $callback = function() use ($list) 
        {
            $FH = fopen('php://output', 'w');
            foreach ($list as $row) { 
                fputcsv($FH, $row);
            }
            fclose($FH);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.details');
    }

    public function createFromBooking($bookingId)
    {
        return view('users.details')->with(compact('bookingId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userService = new UserServices();

        $user = User::create([
            'name'      =>  $request->input('name'),
            'surname'   =>  $request->input('surname'),
            'email'     =>  $request->input('email'),
            'password'  =>  bcrypt('WeRide2017'),
            'phone'     =>  $request->input('phone'),
            'banned'    => 0
        ]);

        $userService->createDriverFromUser($request ,$user->id);

        if(null !== $request->input('booking')){
            $booking = Booking::find($request->input('booking'));
            $booking->user_id = $user->id;
            $booking->save();

            return redirect('/bookings/'.$booking->id.'/edit');
        }

        return redirect('/user/'.$user->id);
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
            $document = Documents::find(1);
            $user = User::find($userId);
            $bookings = Booking::where('user_id','=',$userId)->get();
            $driver = $user->driver;
            return view('users.details')->with(compact('user','bookings','driver','document'));
        }
            return redirect("/");
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
        $userService = new UserServices();

        $user = User::find($request->input('user'));
        $user->name     = $request->input('name');
        $user->surname  = $request->input('surname');
        $user->phone    = $request->input('phone');
        $user->email    = $request->input('email');
        $user->signed = 1;

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
        return redirect('/user/'.$user->id);
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
        $userServices = new UserServices();

        $user = User::find($userId);
        $driver = $user->driver;
        $driver->confirmed = 1;
        $driver->save();

        $userServices->updateUserBookingStatus($user,"Fast Check in");

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
    public function destroy($userId)
    {
        $user = User::find($userId);
        $user->banned = 1;
        $user->save();

        return redirect('/users');
    }
}
