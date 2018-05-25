<?php
namespace App\Services;

use App\Booking;
use App\Drivers;
use App\Scooter;
use App\User;
use Illuminate\Support\Facades\DB;

class DriverService {

	public function getDriverBookings($driver_id){
        $driver = Drivers::find($driver_id);
		return $bookings = $driver->user->bookings;
	}

	public function getDriverFavoriteScooter($driver_id){
		return 	DB::table('bookings')
    					->select('scooters.model',DB::raw('count(scooters.model) as favorite_scooter'))
    					->join('scooters','scooters.id','=','bookings.scooter_id')
    					->where('driver_id','=',$driver_id)
    					->groupBy('scooters.model')
    					->orderBy('favorite_scooter')
    					->first();
	}

}