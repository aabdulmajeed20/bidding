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
        'amount', 'status','purchased_date', 'status'
    ];

    public function user() 
    {
        return $this->belongsTo('App\User');
    }

    public function offer()
    {
        return $this->hasMany('App\Offer');
    }
}
