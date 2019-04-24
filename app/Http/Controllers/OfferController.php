<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Offer;
use App\Provider;
use App\Bid;
use Auth;
use App\Contract;
use GuzzleHttp\Client;
use App\MainFunc;
use Cookie;
class OfferController extends Controller
{

    public function addOffer(Request $request, $bid_id)
    {
        $provider_id = Auth::guard('provider')->id();
        $provider = Provider::where('_id', $provider_id)->first();
        $contract = Contract::where('provider_id', $provider->id)->first();
        $bid = Bid::where('_id', $bid_id)->first();
        $remaining_balance = MainFunc::getBalance();
        if($remaining_balance < $bid->amount && $remaining_balance !== false){
          return abort(403,'Insuffecient Balance');
        }

        $offer = new Offer();
        $offer->price = $request->offerPrice;
        $offer->premium = $request->premiumPrice;
        $offer->currency = $provider->currency;
        if ($remaining_balance) {
          $contract->remaining_balance -= $bid->amount;
          $contract->save();
          }
        $offer->save();
        $provider->offer()->save($offer);
        $bid->offer()->save($offer);
        return redirect()->route('bidDetails', ['bid_id' => $bid_id]);
    }

    public function createOffer($bid_id)
    {
        return view('provider/createOffer', ['bid_id' => $bid_id]);
    }


    public function buyOffer($offer)
    {
        $offer = Offer::where('_id',$offer)->first();

        $issueRequest = $offer->bid()->first();
        $issueRequest->offer_id = $offer->id;
        $bid_Offers = Offer::where('bid_id',$issueRequest->id)->get();

        foreach ($bid_Offers as $checkOffer) {
          if($checkOffer->id != $offer->id){
            $contract = Contract::where('provider_id',$checkOffer->provider_id)->first();
            $contract->remaining_balance += $issueRequest->amount;
            $contract->save();
            $checkOffer->delete();

          }
        }
        $client = new Client();
        $accessToken = Cookie::get('token');
        try {
            $res = $client->post('http://'.env("CBX_API").'/api/Issue', [
                'headers' =>  [
                    'Authorization' => 'Bearer '.$accessToken,
                ],
                'form_params' => [
                    'amount' => $issueRequest->amount,
                    'underwriter' => $offer->provider_id,
                    'currency' => $offer->currency,
                    'price' => $offer->price,
                    'premium' => $offer->premium,
                    'cover' => $issueRequest->cover,
                    'api_key' => base64_encode(env('api_key')),
                    'api_uid' => env('api_uid'),

                ]
            ]);

        } catch (\Throwable $th) {
            return $th;
        }
        $response = json_decode($res->getBody(), false, 512, JSON_BIGINT_AS_STRING);
        $offer->is_purchased = true;
        $issueRequest->status = 'closed';
        $issueRequest->save();
        $offer->save();
        $purchase['request'] = $issueRequest;
        $purchase['offer'] = $offer;
        $purchase['status'] = 'success';
        $purchase['token'] = $response->token;

        return view('purchaseStatus')->with('purchase', $purchase);
    }

}
