<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Scooter;
use App\Booking;
use App\Accessories;
use App\Drivers;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = DB::table('bookings')
                        ->select('scooters.id as scooter_id','pick_up_date','drop_off_date','bookings.id as id','scooters.model','scooters.color','scooters.plate','bookings.status','accessories.name as accessory_name','drivers.firstname','drivers.surname','drivers.phone')
                        ->join('scooters', 'scooters.id','=','bookings.scooter_id')
                        ->join('drivers', 'drivers.id', '=', 'bookings.driver_id')
                        ->join('accessories', 'accessories.id', "=", "bookings.accessories_id")
                        ->orderBy('bookings.pick_up_date','DESC')
                        ->get();

        $scooters = Scooter::all();
        $accessories = Accessories::all();

        $drivers = DB::table('drivers')
                        ->where('confirmed','=',0)
                        ->get();

        $bookings_from_today = DB::table('bookings')
                        ->join('scooters','scooters.id','=','bookings.scooter_id')
                        ->where('pick_up_date', '<=', date('Y-m-d'))
                        ->where('drop_off_date', '>=', date('Y-m-d'))
                        ->get();
        $available = [];

        if(count($bookings) >= 1)
        {
            foreach ($bookings_from_today as $booking) 
            {
                foreach ($scooters as $scooter) 
                {
                    if($scooter->id != $booking->scooter_id && $scooter->plate != $booking->plate)
                    {
                        $available[] = DB::table('scooters')->find($scooter->id);
                    }
                }
            }
        }
        else
        {
            $available = $scooters;
        }

        return view('dashboard.index')->with(compact('bookings','scooters','available','drivers'));
    }
}
