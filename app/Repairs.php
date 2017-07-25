<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repairs extends Model
{
    protected $table = 'repairs';

    protected $fillable = ['scooter_id','date','kilometers','reason','part','status'];

    protected $hidden= [];

    protected $casts = [
    	'id' => 'integer'
    ];

    public function scooter()
    {
    	return $this->belongsTo('App\Scooter');
    }
}
