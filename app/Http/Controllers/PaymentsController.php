<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Payments;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function create(Request $request)
    {
    	Payments::create([
    		'booking_id'	=> $request->input('bookingId'),
    		'paymentDate'	=> $request->input('paymentDate'),
    		'amount'		=> $request->input('amount'),
    		'modality'		=> $request->input('modality')
    	]);

    	return redirect('/bookings/'.$request->input('bookingId').'/edit');
    }

    public function destroy($paymentsId,$bookingId)
    {
    	$payment = Payments::find($paymentsId);
    	$payment->delete();

    	return  redirect('/bookings/'.$bookingId.'/edit');
    }

    public function destroyAndBondBack($paymentsId,$bookingId)
    {
        $booking = Booking::find($bookingId);
        $booking->bondStatus = 0;
        $booking->save();

        return $this->destroy($paymentsId,$bookingId);
    }
}
