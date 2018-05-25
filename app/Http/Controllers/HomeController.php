<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Scooter;
use App\Booking;
use App\Accessories;
use App\Drivers;
use App\Services\ScooterServices2;

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

        $scooters = Scooter::all();
        $drivers = Driver::all();
        
        $bookings_from_today = DB::table('bookings')
                        ->join('scooters','scooters.id','=','bookings.scooter_id')
                        ->where('pick_up_date', '<=', date('Y-m-d'))
                        ->where('drop_off_date', '>=', date('Y-m-d'))
                        ->get();
        $available = $scooterService->getAvailableScootersFromBookingList($bookings_from_today); 


        return view('dashboard.index')->with(compact('bookings','scooters','available','drivers'));
    }

    public function profile()
    {
        $user = Auth::user();
        $driver = $user->drivers();

        return $drivers;
    }
}
