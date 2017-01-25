<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drivers extends Model
{
    protected $table = 'drivers';

    protected $fillable = ['firstname','surname','user_id','email','phone','passport_number','drivers_licence','international'];

    protected $hidden= [];

    protected $casts = [
    	'id' => 'integer'
    ];

    public function user()
    {
    	return $this->hasMany('App\User');
    }

    public function booking()
    {
    	return $this->belongsTo('App\Booking');
    }
}
