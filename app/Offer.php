<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Offer extends Eloquent
{
    //
    protected $connection = 'mongodb';
    protected $collection = 'offers';

    protected $fillable = [
        'is_purchased', 
    ];



    public function provider()
    {
        return $this->belongsTo('App\Provider');
    }

    public function bid()
    {
        return $this->belongsTo('App\Bid');
    }
}
