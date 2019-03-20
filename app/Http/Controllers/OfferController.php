<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Offer;
use App\Provider;
use App\Bid;

class OfferController extends Controller
{

    public function addOffer(Request $request)
    {
        $provider_id = Session::get('provider_id');
        $provider = Provider::where('_id', $provider_id)->first();

        $bid = Bid::where('_id', );
        $offer = new Offer();
        $offer->price = $request->price;
        

    }
    //
}
