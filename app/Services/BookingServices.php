<?php
namespace App\Services;

use App\Booking;
use App\Scooter;
use App\User;
use App\Payments;
use App\BookingHistory;

class BookingServices {
	
	private $booking;
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

	public function GetBookingHistory(Booking $booking)
	{
		$bookingHistories = BookingHistory::where('booking_id','=',$booking->id)->get();
		return $bookingHistories;
	}

	public function addPayment($request)
	{
		if(isset($request->input('payDate') && isset($request->input('amount'))))
		{
			Payments::create([
				'payDate' 	=> $request->input('payDate'),
				'amount'	=> $request->input('amount'),
				'modality'	=> $request->input('modality')
			]);
		}
	}

	public function getPayments(Booking $booking)
	{
		$payments = Payments::where('booking_id','=',$booking->id)->get();
		return $payments;
	}

	// The function compares a Booking Object and Update Requests
	// If something has changed for the booking, then its create a Bookinghistory Object
	public function CheckBookingModifications(Booking $booking)
	{
		$bookingAttributes = $booking->getAttributes();
		
		foreach($bookingAttributes as $key => $value){
			if($this->isWanted($key) && $this->booking->$key != $value){
				BookingHistory::create([
					'booking_id'=> $booking->id,	
					'date' 		=> date('Y-m-d'),
					'object'	=> $this->InHumanWords($key),
					'old_value'	=> $this->InHumanWords($key,$this->booking->$key),
					'new_value'	=> $this->InHumanWords($key,$value)
				]);
			}
		}
	}

	public function isWanted($key)
	{
		$notWantedKeys = ['id','created_at','updated_at'];
		foreach($notWantedKeys as $notWantedKey){
			if($key == $notWantedKey){
				return false;
			}
		}
		return true;
	}

	public function CopyBooking(Booking $booking)
	{
		$this->booking = $booking->replicate();
	}

	public function InHumanWords($objectKey, $objectValue = null)
	{

		$charsToReplace = [
			'_id' 	=> '',
			'_' 	=> ' ',
		];

		// If there is no value with the key, then we need to have a OBJECT KEY translated in human word
		// If there is a value, then we retrieve the corresponding ID to a human understandable value.
		// Ex : @params scooter_id,1 -> returns Scooter->plate

		if($objectValue === null){
			foreach ($charsToReplace as $key => $value) {
				$objectKey = str_replace($key,$value,$objectKey);
			}
			return $objectKey;
		} else{
			switch ($objectKey) {
				case 'scooter_id':
					$scooter = Scooter::find($objectValue);
					if($scooter === null)
					{
						return "";
					}
					return $scooter->plate;
					break;
				
				case 'user_id':
					$user = User::find($objectValue);
					if($user === null){
						return "";
					}
					return $user->name;

				default:
					return $objectValue;
					break;
			}
		}
	}
}