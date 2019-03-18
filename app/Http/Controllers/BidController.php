<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Provider;
use Auth;
use App\Bid;

class BidController extends Controller
{

    public function bidDetails($bid_id)
    {
        $bid = Bid::where('_id', $bid_id)->first();
        return view('bidDetails', ['bid' => $bid]);
    }

    public function createBid()
    {
        return view('addBidding');
    }

    public function addBidding(Request $request)
    {
        $user = Auth::Provider(); 
        return "hello world";
    }

    public function biddingHistory()
    {  
        // $user = Auth::user(); 
        $bids = Bid::where('user_id', '5c8e7f37dc09cf120079933d')->get();
        return view('biddingHistory', ['bids' => $bids]);
    }

}
