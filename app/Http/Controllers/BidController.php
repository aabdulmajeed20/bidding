<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Provider;
use Auth;
use App\Bid;
use App\User;
use Session;

class BidController extends Controller
{

    public function bidDetails($bid_id)
    {
        // $offers = Offer::where('')
        $bid = Bid::where('_id', $bid_id)->first();
        return view('bidDetails', ['bid' => $bid]);
    }

    public function postBid(Request $request)
    {
        $user_id = Session::get('user_id');
        dd(session()->all());

        $user = User::where('_id', $user_id)->first();

        $bid = new Bid ();
        $bid->amount = $request->amount;
        $bid->status = "open";

        $bid =  $user->bid()->save($bid);

        return redirect()->route('biddingHistory');
    }

    public function createBid()
    {
        return view('postBidding');
    }

    public function biddingHistory()
    {  
        $user_id = Session::get('user_id');        
        $bids = Bid::where('user_id', $user_id)->get();
        // $offer = Offer::where('bid_id', $bids->id)->get();
        return view('biddingHistory', ['bids' => $bids]);
    }

    public function allBidding()
    {
        $data = Bid::where('status', 'open')->get();
        return view('provider/allBidding', ['data' => $data]);
    }
}
