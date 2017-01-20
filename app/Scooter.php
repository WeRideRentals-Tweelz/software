<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scooter extends Model
{
    protected $table = 'scooters';

    protected $fillable = ['state','plate','model','year','color','kilometers','last_check'];

    protected $hidden= [];

    protected $casts = [
    	'id' => 'integer'
    ];

    public function booking()
    {
    	return $this->belongsTo('App\Booking');
    }
}
