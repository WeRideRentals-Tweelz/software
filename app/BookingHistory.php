<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingHistory extends Model
{
    protected $table = 'booking_histories';

    protected $fillable = ['booking_id','date','object','old_value','new_value'];

    protected $hidden= [];

    protected $casts = [
    	'id' => 'integer'
    ];

    public function booking()
    {
    	return $this->belongsTo('App\Booking');
    }
}
