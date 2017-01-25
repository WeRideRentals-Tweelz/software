<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accessories extends Model
{
    protected $table = 'accessories';

    protected $fillable = ['name','price','category','scooter_id','info'];

    protected $hidden= [];

    protected $casts = [
    	'id' => 'integer'
    ];

    public function scooter()
    {
    	return $this->hasMany('App\Scooter');
    }

    public function booking()
    {
    	return $this->belongsTo('App\Booking');
    }
}
