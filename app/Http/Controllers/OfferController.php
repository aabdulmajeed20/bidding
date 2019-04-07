<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Offer;
use App\Provider;
use App\Bid;
use Auth;
use GuzzleHttp\Client;
use Cookie;
class OfferController extends Controller
{

    public function addOffer(Request $request, $bid_id)
    {
        //dd($request);
        $provider_id = Auth::guard('provider')->id();
        $provider = Provider::where('_id', $provider_id)->first();
        $bid = Bid::where('_id', $bid_id)->first();
        $offer = new Offer();
        $offer->price = $request->offerPrice;
        $offer->premuim = $request->PremuimPrice;
        $offer->currency = $provider->currency;
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
                ]
            ]);

        } catch (\Throwable $th) {
            return $th;
        }
        $response = json_decode($res->getBody(), false, 512, JSON_BIGINT_AS_STRING);

        $issueRequest->status = 'closed';
        //$issueRequest->save();
        $purchase['request'] = $issueRequest;
        $purchase['offer'] = $offer;
        $purchase['status'] = 'success';
        $purchase['token'] = $response->token;
        //dd($purchase);
        return view('purchaseStatus')->with('purchase', $purchase);
    }

}
