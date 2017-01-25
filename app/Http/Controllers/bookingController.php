<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Booking;
use App\Scooter;
use DateTime;


class bookingController extends Controller
{
    public function index(Request $request)
    {
    	$pick_up_date = $request->input('pick_up_date');
    	$drop_off_date = $request->input('drop_off_date');
        $package = $drop_off_date - $pick_up_date;

    	$scooters = DB::table('scooters')
                    ->where('availability', '<>', 2)
                    ->where('availability', '<>', 3)
                    ->get();

        $bookings = DB::table('bookings')
                        ->join('scooters','scooters.id','=','bookings.scooter_id')
                        ->where('pick_up_date', '<=', $drop_off_date)
                        ->where('drop_off_date', '>=', $pick_up_date)
                        ->get();

        $available = [];

        if(count($bookings) >= 1)
        {
            foreach ($bookings as $booking) 
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

        if($package < 7)
        {
            $price = 30;
        }
        elseif($package >= 7 && $package < 20)
        {
            $price = 25; 
        }
        elseif ($package >= 20) 
        {
            $price = 20;
        }

    	return view('bookings.index')->with(compact('available','pick_up_date','drop_off_date','price'));
    }

    public function store(Request $request)
    {
        $pick_up_date =     $request->input('pick_up_date');
        $drop_off_date =    $request->input('drop_off_date');
        $scooter_id =       $request->input('scooter_id');
        $accessory_id = [];

        if(null !== $request->input('accessory'))
        {
            $accessory_id = $request->input('accessory');
        }
        
        $user = User::find(Auth::user()->id);
        $driver = Driver::find(Auth::user()->driver_id);

        $booking = new Booking([
            'pick_up_date'      =>$pick_up_date,
            'drop_off_date'     =>$drop_off_date,
            'scooter_id'        =>$scooter_id,
            'driver_id'         =>$driver_id,
            'accessory_id'      =>$accessory_id,
            'status'            =>'waiting for confirmation',
            'confirmation'      =>0,
            'created_at'        => new DateTime, 
            'updated_at'        => new DateTime
        ]);

        $booking->save();

        $scooter = Scooter::find($scooter_id);

        //Sending a mail to inform a new booking to admins
        
        $mail_info = ['pick_up_date'=>$pick_up_date,'drop_off_date'=>$drop_off_date, 'scooter'=>$scooter];

        Mail::send('emails.new-booking',$mail_info, function($mail) use ($scooter){
            $mail->from('contact@tweelz.com', 'New scooter booking');

            $mail->to('jb.malandain@gmail.com')->cc('delapierre.t@orange.fr')->cc('thomasleclercq90010@gmail.com');
        });

        return view('bookings.confirmation')->with(compact('pick_up_date','drop_off_date','scooter'));
    }
}
