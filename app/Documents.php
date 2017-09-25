<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    protected $table = "documents";

    protected $fillable = [
    	'id','name','create',
    ];

    protected $hidden = [];

    protected $casts = [
    	'id' => 'integer'
    ];
}
