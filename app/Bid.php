<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Bid extends Eloquent
{
    //
    protected $connection = 'mongodb';
    protected $collection = 'bids';

    protected $fillable = [
        'amount', 'status', 'provider_id','purchased_date', 'status'
    ];

    public function user() 
    {
        return $this->belongsTo('App\User');
    }

    public function provider()
    {
        return $this->belongsToMany('App\Provider');
    }
}
