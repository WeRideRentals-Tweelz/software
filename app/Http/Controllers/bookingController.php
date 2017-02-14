<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\User;
use App\Booking;
use App\Drivers;
use App\Scooter;
use DateTime;


class bookingController extends Controller
{
    public function index()
    {
        $bookings = DB::table('bookings')
                        ->select('scooters.id as scooter_id','pick_up_date','drop_off_date','bookings.id as id','scooters.model','scooters.color','scooters.plate','bookings.status','drivers.id as driver_id','drivers.firstname','drivers.surname','drivers.phone')
                        ->join('scooters', 'scooters.id','=','bookings.scooter_id')
                        ->join('drivers', 'drivers.id', '=', 'bookings.driver_id')
                        ->orderBy('bookings.pick_up_date','DESC')
                        ->get();
        return view('dashboard.bookings')->with(compact('bookings'));
    }

    public function availability(Request $request)
    {
    	$pick_up_date = $request->input('pick_up_date');
    	$drop_off_date = $request->input('drop_off_date');
        $package = $drop_off_date - $pick_up_date;

    	$scooters = Scooter::where('availability', '<>', 2)
                    ->where('availability', '<>', 3)
                    ->orderBy('id', 'ASC')
                    ->get();

        $bookings = Booking::where('pick_up_date', '<=', $drop_off_date)
                        ->where('drop_off_date', '>=', $pick_up_date)
                        ->get();

        $booking_checker = [];
        $scooter_checker = [];

        foreach ($bookings as $booking) 
        {
            $booking_checker[] = $booking->scooter_id;  
        }

        foreach ($scooters as $scooter) 
        {
            $scooter_checker[] = $scooter->id;
        }

        if(count($bookings) >= 1)
        {
           $available = array_diff($booking_checker, $scooter_checker);
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
        $accessory_id = 0;
        $driver = Drivers::where('user_id',Auth::user()->id)->first();

        if(null !== $request->input('accessory'))
        {
            $accessory_id = $request->input('accessory');
        }

        $booking = new Booking([
            'pick_up_date'      =>$pick_up_date,
            'drop_off_date'     =>$drop_off_date,
            'scooter_id'        =>$scooter_id,
            'driver_id'         =>$driver->id,
            'status'            =>'waiting for confirmation',
            'confirmation'      =>0,
            'created_at'        =>new DateTime, 
            'updated_at'        =>new DateTime,
            'accessories_id'    =>$accessory_id
        ]);

        $booking->save();

        $scooter = Scooter::find($scooter_id);

        //Sending a mail to inform a new booking to admins
        
        $mail_info = ['pick_up_date'=>$pick_up_date,'drop_off_date'=>$drop_off_date, 'scooter'=>$scooter];

        Mail::send('emails.new-booking',$mail_info, function($mail) use ($scooter){
            $mail->from('contact@tweelz.com', 'New scooter booking');

            $mail->to('jb.malandain@gmail.com')->cc('delapierre.t@orange.fr')->cc('thomasleclercq90010@gmail.com');
        });

        //Please create a new email for this when the website will be ready
        return view('bookings.confirmation')->with(compact('pick_up_date','drop_off_date','scooter'));
    }

    public function quote(Request $request)
    {
        $lastname       =   $request->input('firstname');
        $surname        =   $request->input('surname');
        $phone          =   $request->input('phone');
        $email          =   $request->input('email');
        $pick_up_date   =   $request->input('pick_up_date');
        $drop_off_date  =   $request->input('drop_off_date');     

        Mail::send('emails.new-booking',['lastname'=>$lastname,'surname'=>$surname,'phone'=>$phone,'email'=>$email,'pick_up_date'=>$pick_up_date,'drop_off_date'=>$drop_off_date], function($mail){
            $mail->to('jb.malandain@gmail.com');
            $mail->cc('delapierre.t@orange.fr');
            $mail->cc('thomasleclercq90010@gmail.com');
            $mail->from('contact@weride.com');
            $mail->subject('WeRide : New scooter booking');
        });

        Mail::send('emails.confirmation',['lastname'=>$lastname,'surname'=>$surname,'phone'=>$phone,'email'=>$email,'pick_up_date'=>$pick_up_date,'drop_off_date'=>$drop_off_date], function($mail) use ($email) {
            $mail->to($email);
            $mail->from('contact@weride.com');
            $mail->subject('We Ride - Your rendez-vous confirmation');
        });

        Session::flash('success', 'We well received your demand, you will receive a confirmation email soon.');

        return redirect()->back();
    }
}
