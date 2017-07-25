<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tolls extends Model
{
    protected $table = 'tolls';

    protected $fillable = ['Date','Time','LicencePlate','Tag','TagName','Group','On','Lane','VehicleType','Amount'];

    protected $hidden = [];

    protected $casts = [
    	'id'	=>	'integer',
    ];

    public function scooter()
    {
    	$this->belongsTo('App\Scooter');
    } 
}
