<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Contract extends Eloquent
{
    //
    protected $connection = 'mongodb';
    protected $collection = 'contracts';

    protected $fillable = [
        'amount', 'remaining_balance', 'contract_number'
    ];

    public function provider()
    {
        return $this->belongsTo('App\Provider');
    }
}
