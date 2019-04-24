<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contract;
use Auth;
use App\Provider;

class ContractController extends Controller
{

    public function addContract(Request $request)
    {

        $provider_id = Auth::guard('provider')->id();
        $provider = Provider::where('_id', $provider_id)->first();
        $contract = new Contract();

        if($request->has('physical')){
          $contract->amount = $request->physical;
          $contract->remaining_balance = $request->physical;
        }


        // must check if the number exist or not
        $contract->contract_number = mt_rand(1000000000, mt_getrandmax());
        $provider->contract()->save($contract);

        return redirect()->route('underwriter.home');
    }

    public function createContract()
    {
        return view('provider/createContract');
    }
}
