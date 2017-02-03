<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';

    protected $fillable = ['pick_up_date','drop_off_date','scooter_id','driver_id','accessories_id','status','confirmation','created_at','updated_at'];

    protected $hidden= [];

    protected $casts = [
    	'id' => 'integer'
    ];	

    public function scooter()
    {
    	return $this->hasMany('App\Scooter');
    }

    public function drivers()
    {
        return $this->hasMany('App\Drivers');
    }

    public function accessories()
    {
        return $this->hasMany('App\Accessories');
    }
}
