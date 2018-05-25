<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'email', 'password','phone','banned','signed'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'role_id' => 'integer'
    ];
    
    public function driver()
    {
        return $this->hasOne('App\Drivers');
    }

    public function roles()
    {
        return $this->hasMany('App\Roles');
    }

    public function bookings()
    {
        return $this->hasMany('App\Booking');
    }

    public function quotes()
    {
        return $this->hasMany('App\Quote');
    }
}
