<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Provider;
use Auth;
use App\Bid;
use App\User;
use App\Offer;
use App\Contract;
use Session;

class BidController extends Controller
{

    public function bidDetails($bid_id)
    {
      $offerable = True;
      $bid = Bid::where('_id', $bid_id)->first();
      //check if Request exist, if not .. 404
      if(empty($bid)) return abort(404);


      if(Auth::guard('provider')->check()){
       
        $offers = Offer::where('bid_id', $bid_id)->where('provider_id',Auth::guard('provider')->id())->get()->count();

        if($provider_contract = Contract::where('provider_id', Auth::guard('provider')->id())->where('remaining_balance', '>' , 0)->first()){
          // dd(Contract::where('provider_id', Auth::guard('provider')->id())->where('remaining_balance', '>' , 0)->first()->remaining_balance);
          if($offers > 0 || $provider_contract->remaining_balance < $bid->amount) {
            $offerable = False;
          }
        } 
        else{
          $offerable = False;
        }

        $offers = Offer::where('bid_id', $bid_id)->where('provider_id',Auth::guard('provider')->id())->get();

      }else{
        $offers = Offer::where('bid_id', $bid_id)->get();
        //check if Request Belong to User..
        $user_id = Session::get('user_id');
        //if Not .. 403 -> unAutherized
        if($bid->user_id != $user_id) return abort(403);
      }

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
      if(Auth::guard('provider')->check()){
        $data = Bid::where('status', 'open')->get();
        $contract = Contract::where('provider_id', Auth::guard('provider')->id())->where('remaining_balance', '>' , 0)->first();
        $remaining_balance = 0;
        if ($contract) {
          $remaining_balance = $contract->remaining_balance; 
        }

        return view('provider/allBidding', ['data' => $data, 'remaining_balance' => $remaining_balance ]);
      }else{
        return abort(401);
      }
    }
}
