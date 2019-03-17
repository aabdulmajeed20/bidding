<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Provider extends Eloquent
{
    //
    protected $connection = 'mongodb';
    protected $collection = 'providers';

    protected $fillable = [
        'name', 'picture',
    ];

    public function bid()
    {
        return $this->belongsToMany('App\Bid');
    }
}
