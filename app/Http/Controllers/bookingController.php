<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\QuoteRequest;
use App\User;
use App\Booking;
use App\Drivers;
use App\Scooter;
use DateTime;

use App\Services\checkUser;


class bookingController extends Controller
{
    public function index()
    {
        $bookings = booking::all();
        return view('admin.index')->with(compact('bookings'));
    }

    public function availability(Request $request)
    {
    	$pick_up_date = $request->input('pick_up_date');
    	$drop_off_date = $request->input('drop_off_date');
        $package = $drop_off_date - $pick_up_date;

    	$scooters = Scooter::where('availability', '<>', 2)
                    ->where('availability', '<>', 3)
                    ->orderBy('id', 'ASC')
                    ->get();

        $bookings = Booking::where('pick_up_date', '<=', $drop_off_date)
                        ->where('drop_off_date', '>=', $pick_up_date)
                        ->get();

        $booking_checker = [];
        $scooter_checker = [];

        foreach ($bookings as $booking) 
        {
            $booking_checker[] = $booking->scooter_id;  
        }

        foreach ($scooters as $scooter) 
        {
            $scooter_checker[] = $scooter->id;
        }

        if(count($bookings) >= 1)
        {
           $available = array_diff($booking_checker, $scooter_checker);
        }
        else
        {
            $available = $scooters;
        }

        if($package < 7)
        {
            $price = 30;
        }
        elseif($package >= 7 && $package < 20)
        {
            $price = 25; 
        }
        elseif ($package >= 20) 
        {
            $price = 20;
        }

    	return view('bookings.index')->with(compact('available','pick_up_date','drop_off_date','price'));
    }

    public function store(Request $request)
    {
            $name           =   $request->input('name');
            $phone          =   $request->input('phone');
            $email          =   $request->input('email');
            $pickUp        =   date("Y-m-d",strtotime(str_replace('/','-',$request->input('pickUp'))));
            $dropOff        =  date("Y-m-d",strtotime(str_replace('/','-',$request->input('dropOff'))));

            Booking::create([
                "pick_up_date"      =>      $pickUp,
                "drop_off_date"     =>      $dropOff,
                "scooter_id"           =>       1,
                "driver_id"              =>       1
            ]); 

            // Use an event listener to send a confirmation email
            Session::flash('success','You will receive a confirmation email soon');
            return redirect("/"); 
    }

    public function quote(QuoteRequest $request)
    {
        // Check if dates are correct
        $today = date("Y-m-d");
        if($pickUp >= $dropOff || $pickUp < $today || $dropOff <= $today)
        {
            Session::flash("error","Please consider choosing dates after today's date");
            return redirect()->back();
        }

        // Then use a Service to check the status of the session (guest or existing user)
        // and redirect him accordingly to conclude its booking

        $checkUser = new CheckUser($request);
        $checkUser->check();
}
