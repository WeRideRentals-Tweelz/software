<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    protected $table = 'payments';

    protected $fillable = ['booking_id','paymentDate','amount','modality'];

    protected $hidden= [];

    protected $casts = [
    	'id' => 'integer'
    ];

    public function booking()
    {
    	return $this->belongsTo('App\Booking');
    }
}
