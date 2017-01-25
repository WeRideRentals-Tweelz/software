<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $table = 'roles';

    protected $fillable = ['role'];

    protected $hidden= [];

    protected $casts = [
    	'id' => 'integer'
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
