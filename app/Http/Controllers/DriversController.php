<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Drivers;
use App\Services\DriverService;

class DriversController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
    	$drivers = Drivers::where('confirmed','<>',0)->get();

    	$new_drivers = Drivers::where('confirmed','=',0)->get();

    	return view('dashboard.drivers')->with(compact('drivers','new_drivers'));
    }

    public function show($driver_id)
    {
        $driverService = new DriverService();
    	
        $driver = Drivers::find($driver_id);
    	$bookings = $driverService->getDriverBookings($driver_id);
    	$favorite_scooter = $driverService->getDriverFavoriteScooter($driver_id);

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
