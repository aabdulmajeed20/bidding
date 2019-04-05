<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Provider;
use Auth;
use App\Bid;
use App\User;
use App\Offer;
use Session;

class BidController extends Controller
{

    public function bidDetails($bid_id)
    {
      $offerable = True;
      if(Auth::guard('provider')->check()){

        $offers = Offer::where('bid_id', $bid_id)->where('provider_id',Auth::guard('provider')->id())->get()->count();
        if($offers > 0) $offerable = False;
      }
        if(Auth::guard('provider')->check()){
          $offers = Offer::where('bid_id', $bid_id)->where('provider_id',Auth::guard('provider')->id())->get();
        }else{
          $offers = Offer::where('bid_id', $bid_id)->get();
        }
        $bid = Bid::where('_id', $bid_id)->first();
        return view('bidDetails', ['bid' => $bid, 'offers' => $offers, 'offerable' => $offerable]);
    }

    public function postBid(Request $request)
    {
        $user_id = Session::get('user_id');
        $user = User::where('_id', $user_id)->first();
        
        $bid = new Bid ();
        $bid->amount = $request->amount;
        $bid->cover = $request->cover;
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
        return view('biddingHistory', ['bids' => $bids]);
    }

    public function allBidding()
    {
        $data = Bid::where('status', 'open')->get();
        return view('provider/allBidding', ['data' => $data]);

    }
}
