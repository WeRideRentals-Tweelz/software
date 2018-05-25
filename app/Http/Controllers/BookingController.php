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
        $bookingService = new BookingServices(); 
        $bookings = Booking::where('bond_return','>=',$bookingService->setTimeForAustralia('date'))
        ->where('scooter_id', '!=',0)
        ->orWhere('drop_off_time','=',' ')
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

    public function pastUpdate(){
        $bookingService = new BookingServices(); 
        $bookings = Booking::where('bond_return','>=',$bookingService->setTimeForAustralia('date'))
        ->orWhere('drop_off_time','=',' ')
        ->orderBy('pick_up_date','ASC')->get();
        
        return view('bookings.index-past')->with(compact('bookings'));
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
        $bookingServices = new BookingServices();
        
        $booking = Booking::create([
            'pick_up_date'      =>      $bookingServices->mixDateAndTimeData(
                                            $request->input('pick_up_date'), 
                                            $request->input('pick_up_time')
                                        ),
            'pick_up_time'      =>      $request->input('pick_up_time'),
            'drop_off_date'     =>      $bookingServices->mixDateAndTimeData(
                                            $request->input('drop_off_date'), 
                                            $request->input('drop_off_time')
                                        ),
            'drop_off_time'     =>      $request->input('drop_off_time'),
            'scooter_id'        =>      $bookingServices->filterForNotNullData($request->input('scooter')),
            'user_id'           =>      $bookingServices->filterForNotNullData($request->input('user')),
            'status'            =>      "Regular Booking",
            'confirmation'      =>      1,
        ]);

        $bookingServices->setBookingBondReturnDate($booking);

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
        $document = Documents::find(2);

        $bookingService = new BookingServices();
        $bookingHistories = $bookingService->GetBookingHistory($booking);

        $payments = $bookingService->getPayments($booking);

        // Create a service that returns only Available scooters
        $scooterService = new ScooterServices2();
        $scooters = $scooterService->availableScooters($booking);

        $users = User::where('banned','=',0)->get();
        return view('bookings.edit')->with(compact('booking','scooters','users','bookingHistories','payments','document'));
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

        $booking->pick_up_date      =   $bookingService->mixDateAndTimeData(
                                            $request->input('pick_up_date'), 
                                            $request->input('pick_up_time')
                                        );
        $booking->pick_up_time      =   $request->input('pick_up_time');
        $booking->drop_off_date     =   $bookingService->mixDateAndTimeData(
                                            $request->input('drop_off_date'), 
                                            $request->input('drop_off_time')
                                        );
        $booking->drop_off_time     =   $request->input('drop_off_time');
        $booking->bond_return       =   $bookingService->getBondDateBasedOnDropOffDate(
                                            $request->input('drop_off_date')
                                        );
        $booking->scooter_id        =   $bookingService->filterForNotNullData(
                                            $request->input('scooter')
                                        );
        $booking->user_id           =   $bookingService->filterForNotNullData(
                                            $request->input('user')
                                        );
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
        $bookings = booking::where('confirmation','=',1)->where('scooter_id','!=',0)->get();
        $bookingService = new BookingServices();
        $bonds = $bookingService->BondPaymentReminder($bookings);    
        return view('admin.index')->with(compact('bookings','bonds'));
    }

    public function onHold(){
        $bookingService = new BookingServices(); 
        $bookings = Booking::where('scooter_id', '=',0)
        ->where('bond_return','>=',$bookingService->setTimeForAustralia('date'))
        ->orderBy('pick_up_date','ASC')->get();
        /*
        ->where('bond_return','>=',$bookingService->setTimeForAustralia('date'))
        ->orWhere('drop_off_time','=',' ')
        ->orderBy('pick_up_date','ASC')->get();
        */
        $page = 'hold';
        
        return view('bookings.index')->with(compact('bookings','page'));        
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

    public function stopBooking($bookingId)
    {
        $booking = Booking::find($bookingId);
        $bookingService = new BookingServices();
        $bookingService->CopyBooking($booking);

        $booking->acknowledged = 2;
        $booking->drop_off_time = $bookingService->setTimeForAustralia('time');
        $booking->save();

        $bookingService->CheckBookingModifications($booking);
        
        return redirect('/bookings/'.$booking->id.'/edit');
    }

}
