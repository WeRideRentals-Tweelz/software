<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScooterParts extends Model
{
    protected $table = 'scooter_parts';

    protected $fillable = ['name','EmissionControlItem','RepairStatus'];

    protected $hidden= [];

    protected $casts = [
    	'id' => 'integer'
    ];
}
