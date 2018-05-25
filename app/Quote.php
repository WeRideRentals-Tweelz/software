<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $table = 'quotes';

    protected $fillable = ['name','surname','phone','email','start','end'];

    protected $hidden = [];

    protected $casts = [
    	"id" => 'integer'
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
