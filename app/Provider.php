<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
// use DesignMyNight\Mongodb\Auth\User as Authenticatable;
use Jenssegers\Mongodb\Auth\User as Authenticatable;

class Provider extends Authenticatable
{
    use Notifiable;

    protected $connection = 'mongodb';
    protected $collection = 'providers';

    protected $guard = 'provider';

    protected $fillable = [
        'name', 'email', 'coverage', 'escrow_account', 'portfolio_size'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function offer()
    {
        return $this->hasMany('App\Offer');
    }

    public function contract()
    {
        return $this->hasMany('App\Contract');
    }
}
