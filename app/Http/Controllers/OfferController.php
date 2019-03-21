<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Offer;
use App\Provider;
use App\Bid;
use Auth;

class OfferController extends Controller
{

    public function addOffer(Request $request, $bid_id)
    {
        $provider_id = Auth::guard('provider')->id();
        $provider = Provider::where('_id', $provider_id)->first();

        $bid = Bid::where('_id', $bid_id)->first();
        $offer = new Offer();
        $offer->price = $request->price;
        $offer->save();
        $provider->offer()->save($offer);
        $bid->offer()->save($offer);
        return redirect()->route('bidDetails', ['bid_id' => $bid_id]);
    }

    public function createOffer($bid_id)
    {
        return view('provider/createOffer', ['bid_id' => $bid_id]);
    }
    //
}
