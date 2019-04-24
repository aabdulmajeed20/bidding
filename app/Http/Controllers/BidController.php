<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Provider;
use Auth;
use App\Bid;
use App\User;
use App\Offer;
use App\Contract;
use App\MainFunc;
use Session;

class BidController extends Controller
{

    public function bidDetails($bid_id)
    {
      $offerable = True;
      $bid = Bid::where('_id', $bid_id)->first();
      //check if Request exist, if not .. 404
      if(empty($bid)) return abort(404 , 'The Request Does Not Exist');


      if(Auth::guard('provider')->check()){

        $offers = Offer::where('bid_id', $bid_id)->where('provider_id',Auth::guard('provider')->id())->get()->count();
        $provider_contract = Contract::where('provider_id', Auth::guard('provider')->id())->first();
        $remaining_balance = MainFunc::getBalance();

        if($remaining_balance !== false && $remaining_balance < $bid->amount){

            $offerable = False;
        }elseif($offers > 0) {
            $offerable = False;
                  }

        $offers = Offer::where('bid_id', $bid_id)->where('provider_id',Auth::guard('provider')->id())->get();

      }else{
        $offers = Offer::where('bid_id', $bid_id)->orderBy('premium','ASC')->get();
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
        if($request->market != 'none') $bid->market = $user->country;
        $bid = $user->bid()->save($bid);
        $bid->request_number = hash('sha256', $bid->id.$user_id.rand(999,9999999999).date('his'));
        $bid->save();

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
        $data = Bid::where('cover', Auth::guard('provider')->user()->cover)->orderBy('created_at','DESC')->get();
        $contract = Contract::where('provider_id', Auth::guard('provider')->id())->first();
        $remaining_balance = MainFunc::getBalance();

        return view('provider/allBidding', ['data' => $data, 'remaining_balance' => $remaining_balance ]);
      }else{
        return abort(401);
      }
    }
}
