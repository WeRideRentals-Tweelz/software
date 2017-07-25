<?php
namespace App\Services;

use App\Booking;

class BookingServices {
	
	/*
	*
	*	Return an array with the bonds due date depending on their booking numbers
	*
	*/
	public function BondPaymentReminder($bookings)
	{
		$bonds = [];

		foreach($bookings as $booking)
		{
			$bookingNumber = $booking->id;
			$bondDate = date('Y-m-d',strtotime($booking->drop_off_date.'+ 10 days'));
			$userName = isset($booking->user) ? $booking->user->name : "No User"; 
			$bonds[] = ['bookingNumber' => $bookingNumber,'bondDate' => $bondDate, 'bondName' => $userName ];
		}

		return $bonds;
	}
}