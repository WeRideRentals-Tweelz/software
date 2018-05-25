<?php 
namespace App\Services;

use App\Booking;
use App\Quote;
use App\User;
use App\Services\DateTransformationService;
use App\Services\BookingServices;
use App\Services\UserServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class QuoteServices {

	public function checkQuoteDates($start,$end){
		$dateService = new DateTransformationService();

		$start = $dateService->formatForStorage($start);
		$end = $dateService->formatForStorage($end);

		if($start > $end || $start < $dateService->setTimeForAustralia() || $end < $dateService->setTimeForAustralia() ){
			
			Session::flash("error","Please consider choosing dates after today's date");
            return redirect()->back();
		}
	}

	public function confirmQuote(Quote $quote){
		$user = User::where('email','=',$quote->email)->first();
		$dateService = new DateTransformationService();
		$bookingServices = new BookingServices();
        
        $booking = Booking::create([
            'pick_up_date'      =>      $bookingServices->mixDateAndTimeData($quote->start),
            'pick_up_time'      =>      $bookingServices->filterForNotNullTime(),
            'drop_off_date'     =>      $bookingServices->mixDateAndTimeData($quote->end),
            'drop_off_time'     =>      $bookingServices->filterForNotNullTime(),
            'scooter_id'        =>      $bookingServices->filterForNotNullData(null),
            'user_id'           =>      $bookingServices->filterForNotNullData($user->id),
            'status'            =>      "Regular Booking",
            'confirmation'      =>      1,
        ]);

        $bookingServices->setBookingBondReturnDate($booking);

        return redirect('/profile');
	}

}