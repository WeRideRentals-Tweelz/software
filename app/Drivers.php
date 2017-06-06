<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drivers extends Model
{
    protected $table = 'drivers';

    protected $fillable = ['user_id','date_of_birth','address','drivers_licence','licence_state','expiry_date',"confirmed"];

    protected $hidden= [];

    protected $casts = [
    	'id' => 'integer'
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
