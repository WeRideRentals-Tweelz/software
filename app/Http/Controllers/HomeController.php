<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Scooter;
use App\Booking;

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
                        ->select('scooters.id as scooter_id','pick_up_date','drop_off_date','bookings.id as id','scooters.model','scooters.color','scooters.plate')
                        ->join('scooters', 'scooters.id','=','bookings.scooter_id')
                        ->orderBy('bookings.pick_up_date','DESC')
                        ->get();

        $scooters = Scooter::all();

        return view('dashboard.index')->with(compact('bookings','scooters'));
    }
}
