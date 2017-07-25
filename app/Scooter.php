<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scooter extends Model
{
    protected $table = 'scooters';

    protected $fillable = ['state','plate','model','year','color','kilometers','category','last_check','last_kilometers_check','availability'];

    protected $hidden= [];

    protected $casts = [
    	'id' => 'integer'
    ];

    public function booking()
    {
    	return $this->belongsTo('App\Booking');
    }

    public function accessories()
    {
        return $this->belongsTo('App\Accessories');
    }
}
