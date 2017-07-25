<?php

namespace App\Http\Controllers;

//Vendors
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use DateTime;
// Requests
use App\Http\Requests\QuoteRequest;
// Models    
use App\User;
use App\Booking;
use App\Drivers;
use App\Scooter;
//Services
use App\Services\checkUser;
use App\Services\EmailSender;
use App\Services\BookingServices;
use App\Services\ScooterServices;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except('quote','confirmBooking');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date = date('Y-m-d'); 
        $bookings = Booking::where('confirmation','=',1)->where('drop_off_date',">=",$date)->orderBy('pick_up_date','asc')->get();
        return view('bookings.index')->with(compact('bookings'));
    }

    public function pastbookings(Request $request)
    {
        if($request->input('date') === null){
            return view('bookings.pastbookings'); 
        }
        $date = $request->input('date').'-01';
        $maxDate = $request->input('date').'-31';
        $bookings = Booking::where('confirmation','=',1)->where('pick_up_date','>=',$request->input('date'))->where('pick_up_date','<=',$maxDate)->orderBy('pick_up_date','asc')->get();
        
        return view('bookings.pastbookings')->with(compact('bookings','date'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        $users = User::where('banned','=',0)->get();
        return view('bookings.edit')->with(compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $scooterId = $request->input('scooter');
        if($scooterId === null)
        {
            $scooterId = 0;
        }

        $userId = $request->input('user');
        if($userId === null)
        {
            $userId = 0;
        }

        $booking = Booking::create([
            'pick_up_date'      =>      $request->input('pick_up_date'),
            'drop_off_date'     =>      $request->input('drop_off_date'),
            'scooter_id'        =>      $scooterId,
            'user_id'           =>      $userId,
            'status'            =>      "Regular Booking", //Create a service that check on user to change it automaticly
            'confirmation'      =>      1,
        ]);

        return redirect('/bookings');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        // Create a service that returns only Available scooters
        $scooterService = new ScooterServices();
        $scooters = $scooterService->scootersAvailable($booking);
        $users = User::where('banned','=',0)->get();
        return view('bookings.edit')->with(compact('booking','scooters','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        $booking->pick_up_date      = $request->input('pick_up_date');
        $booking->drop_off_date     = $request->input('drop_off_date');
        $booking->scooter_id        = $request->input('scooter');
        $booking->user_id           = $request->input('user');
        $booking->save();

        return redirect('/bookings/'.$booking->id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect('/bookings');
    }


    /**
    *   Shows the confirmed bookings into a dashboard 
    *   @return \Illuminate\Http\Response
    */
    public function dashboard()
    {
        $bookings = booking::where('confirmation','=',1)->get();
        $bookingService = new BookingServices();
        $bonds = $bookingService->BondPaymentReminder($bookings);    
        return view('admin.index')->with(compact('bookings','bonds'));
    }

    /**
    *   Create user then a prebooking
    *     
    *   @return \App\Http\Services\CheckUser
    */
    public function quote(QuoteRequest $request)
    {
            $name           =   $request->input('name');
            $phone          =   $request->input('phone');
            $email          =   $request->input('email');
            $pickUp        =   date("Y-m-d",strtotime(str_replace('/','-',$request->input('pickUp'))));
            $dropOff        =  date("Y-m-d",strtotime(str_replace('/','-',$request->input('dropOff'))));

            // Check if dates are correct
            $today = date("Y-m-d");
            if($pickUp >= $dropOff ) // || Change that security to avoid people adding dates before today's date = > $pickUp < $today || $dropOff <= $today 
            {
                Session::flash("error","Please consider choosing dates after today's date");
                return redirect()->back();
            }

            $booking = Booking::create([
                "pick_up_date"      =>      $pickUp,
                "drop_off_date"     =>      $dropOff
            ]); 

        // Then use a Service to check the status of the session (guest or existing user)
        // and redirect him accordingly to conclude its booking

        $checkUser = new CheckUser($request,$booking->id);
        return $checkUser->check();
    }

    /**
    *   After the user login or register, confirms its booking
    *   Params Path =>   App\Http\Controllers\Auth\LoginController
    *   || Params Path =>   App\Http\Controllers\Auth\RegisterController
    *   @param  App\Booking  $booking->id
    *   @param  App\User     $user->email
    *   @return Illuminate\Http\Response
    */
    public function confirmBooking($bookingId,$email)
    {

        $user = User::where('email','=',$email)->first();    
        $booking = Booking::find($bookingId);
        $booking->status = "Regular Booking";
        $booking->confirmation = 1;
        $booking->user_id = $user->id;
        $booking->save();

        $sendEmail = new EmailSender($user->email);
        $sendEmail->confirmation($booking);

        Session::flash('success','Thank you for booking with us ! For a faster check-in, consider filling your information in your profile.');
        return redirect('/');
    }

}
