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
use App\Documents;
use App\Drivers;
use App\Scooter;
//Services
use App\Services\checkUser;
use App\Services\EmailSender;
use App\Services\BookingServices;
use App\Services\ScooterServices2;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except('quote','confirmBooking','confirmUser','refusedToSign');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date = date('Y-m-d', strtotime('+ 10 days')); 
        $bookings = Booking::where('bond_return','>=',$date)
        ->orWhere('drop_off_time','=',' ')
        ->where('confirmation','=',1)
        ->orderBy('pick_up_date','ASC')->get();
        
        return view('bookings.index')->with(compact('bookings'));
    }

    public function pastbookings(Request $request)
    {
        if($request->input('date') === null){
            return view('bookings.pastbookings'); 
        }
        $date = $request->input('date').'-01';
        $maxDate = $request->input('date').'-31';
        $bookings = Booking::where('confirmation','=',1)->where('pick_up_date','>=',$date)->where('pick_up_date','<=',$maxDate)->where('drop_off_date','<',date('Y-m-d'))->where('drop_off_time','!=',' ')->orderBy('pick_up_date','asc')->get();
        
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

        
        $pickUp = $request->input('pick_up_time');
        $dropOff = $request->input('drop_off_time');
        if($pickUp == '' || $dropOff == ''){
            $pickUp = '23:59:59';
            $dropOff = '23:59:59';
        }
        
        $booking = Booking::create([
            'pick_up_date'      =>      date('Y-m-d H:i:s',strtotime($request->input('pick_up_date')." ".$pickUp)),
            'pick_up_time'      =>      $request->input('pick_up_time'),
            'drop_off_date'     =>      date('Y-m-d H:i:s', strtotime($request->input('drop_off_date').' '.$dropOff)),
            'drop_off_time'     =>      $request->input('drop_off_time'),
            'scooter_id'        =>      $scooterId,
            'user_id'           =>      $userId,
            'status'            =>      "Regular Booking",
            'confirmation'      =>      1,
        ]);

        $booking->bond_return = date('Y-m-d',strtotime($booking->drop_off_date) + (24*3600*10));
        $booking->save();

        if(Auth::user()->role_id != 1){
            return redirect('/profile');
        }
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
        $bookingService = new BookingServices();
        $bookingHistories = $bookingService->GetBookingHistory($booking);

        $payments = $bookingService->getPayments($booking);

        // Create a service that returns only Available scooters
        $scooterService = new ScooterServices2();
        $scooters = $scooterService->availableScooters($booking);

        $users = User::where('banned','=',0)->get();
        return view('bookings.edit')->with(compact('booking','scooters','users','bookingHistories','payments'));
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
        $bookingService = new BookingServices();
        $bookingService->CopyBooking($booking);
        $bookingService->addPayment($booking->id,$request);

        $pickUp = $request->input('pick_up_time');
        $dropOff = $request->input('drop_off_time');
        if($pickUp == ''){
            $pickUp = '23:59:59';
        }
        if($dropOff == ''){ 
            $dropOff = '23:59:59';
        }

        $booking->pick_up_date      = date('Y-m-d H:i:s',strtotime($request->input('pick_up_date')." ".$pickUp));
        $booking->pick_up_time      = $request->input('pick_up_time');
        $booking->drop_off_date     = date('Y-m-d H:i:s', strtotime($request->input('drop_off_date')." ".$dropOff));
        $booking->drop_off_time     = $request->input('drop_off_time');
        $booking->bond_return       = date('Y-m-d',strtotime($request->input('drop_off_date')) + (24*3600*10));
        $booking->scooter_id        = $request->input('scooter');
        $booking->user_id           = $request->input('user');
        $booking->save();

        $bookingService->CheckBookingModifications($booking);

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

    public function payBond($bookingId){
        $booking = Booking::find($bookingId);
        $booking->bondStatus = 1;
        $booking->save();
        return redirect('/home');
    }

    public function payBondFinancial($bookingId){
        $booking = Booking::find($bookingId);
        $booking->bondStatus = 1;
        $booking->save();

        $bookingService = new BookingServices();
        $bookingService->addPayment($bookingId);

        return redirect('/home');
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
    public function confirmBooking(Request $request)
    {
        $user = User::find($request->input('userId')); 
        $user->signed = 1;
        $user->save();

        if($request->input('bookingId') !== null){
            $booking = Booking::find($request->input('bookingId'));
            $booking->status = "Regular Booking";
            $booking->confirmation = 1;
            $booking->user_id = $user->id;
            $booking->save();

            $booking->bond_return = date('Y-m-d',strtotime($booking->drop_off_date) + (24*3600*10));
            $booking->save();

            $sendEmail = new EmailSender($user->email);
            $sendEmail->confirmation($booking);

            Session::flash('success','Thank you for booking with us ! For a faster check-in, consider filling your information in your profile.');
            return redirect('/profile');
        }
        Session::flash('success','You well created your profile '.$user->surname.' !');
        return redirect('/profile');
    }

    public function storeBooking(Request $request, $bookingId)
    {
        $user = User::find($request->input('userId')); 

        $booking = Booking::find($bookingId);
        $booking->status = "Regular Booking";
        $booking->confirmation = 1;
        $booking->user_id = $user->id;
        $booking->save();

        $booking->bond_return = date('Y-m-d',strtotime($booking->drop_off_date) + (24*3600*10));
        $booking->save();

        $sendEmail = new EmailSender($user->email);
        $sendEmail->confirmation($booking);

        Session::flash('success','Thank you for booking with us ! For a faster check-in, consider filling your information in your profile.');
        return redirect('/profile');
    }

    public function confirmUser($email,$bookingId=null)
    {
        $document = Documents::where('name','WeRide Scooter Rentals by Tweelz, Terms and Conditions')->first();

        $user = User::where('email','=',$email)->first();    
        if($user->signed){
            return redirect('/profile');
        }
        if($bookingId === null){
            return view('users.details')->with(compact('user','document'));
        }
        return view('users.details')->with(compact('user','bookingId','document'));
    }

    public function refusedToSign($userId,$bookingId=null)
    {
        if($bookingId !== null){
            $booking = Booking::find($bookingId);
            $booking->delete();
        }
        Auth::logout();
        Session::flash('error','Sorry we cannot allow you to make a reservation without agreeing with our Terms & Conditions of Sale');
        return redirect('/');
    }

}
