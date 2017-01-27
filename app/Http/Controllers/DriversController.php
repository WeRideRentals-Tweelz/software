<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Drivers;
use App\Booking;

class DriversController extends Controller
{
    public function index()
    {
    	$drivers = Drivers::where('confirmed','<>',0)->get();

    	$new_drivers = Drivers::where('confirmed','=',0)->get();

    	return view('dashboard.drivers')->with(compact('drivers','new_drivers'));
    }

    public function show($driver_id)
    {
    	$driver = Drivers::find($driver_id);
    	$bookings = DB::table('bookings')
    					->join('scooters','scooters.id','=','bookings.scooter_id')
    					->where('driver_id','=',$driver_id)
    					->get();

    	$favorite_scooter = DB::table('bookings')
    					->select('scooters.model',DB::raw('count(scooters.model) as favorite_scooter'))
    					->join('scooters','scooters.id','=','bookings.scooter_id')
    					->where('driver_id','=',$driver_id)
    					->groupBy('scooters.model')
    					->orderBy('favorite_scooter')
    					->first();				

    	return view('dashboard.driver-details')->with(compact('driver','bookings','favorite_scooter'));
    }

    public function confirm($driver_id)
    {
    	$driver = Drivers::find($driver_id);
    	
    	switch($driver->confirmed)
    	{
    		case 0:
    		$driver->confirmed = 1;
    		break;

    		case 1:
    		$driver->confirmed = 2;
    		break;

    		case 2:
    		$driver->confirmed = 1;
    		break;
    	}

    	$driver->save();	

    	return back();
    }

    public function update(Request $request, $driver_id)
    {
    	$driver = Drivers::find($driver_id);

    	$driver->firstname 		=	$request->input('firstname');
    	$driver->surname		=	$request->input('surname');
    	$driver->email 			=	$request->input('email');
    	$driver->phone 			=	$request->input('phone');

    	$driver->save();

    	return back();
    }
}
