<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use DesignMyNight\Mongodb\Auth\User as Authenticatable;

class Provider extends Authenticatable
{
    use Notifiable;

    protected $connection = 'mongodb';
    protected $collection = 'providers';

    protected $guard = 'provider';

    protected $fillable = [
        'name', 'email', 'picture',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function bid()
    {
        return $this->belongsToMany('App\Bid');
    }
}
