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

        $provider_contract = Contract::where('provider_id', $provider->id)->where('remaining_balance', '>' , 0)->first();

        if ($provider_contract) {
            $contract->amount = $provider_contract->remaining_balance; 
            $provider_contract->remaining_balance = 0;
            $provider_contract->save();
        }

        $contract->amount += $request->amount; 
        $contract->remaining_balance = $contract->amount;

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
