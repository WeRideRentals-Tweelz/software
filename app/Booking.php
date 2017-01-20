<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';

    protected $fillable = ['pick_up_date','drop_off_date','scooter_id','year','availability'];

    protected $hidden= [];

    protected $casts = [
    	'id' => 'integer'
    ];	

    public function scooter()
    {
    	return $this->hasMany('App\Scooter');
    }
}
