<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contract;
use Auth;
use App\Provider;

class ContractController extends Controller
{

    public function contractOption()
    {
        return view('provider/contractOption');
    }

    public function addContract(Request $request, $contract_type)
    {
        $provider = Provider::find(Auth::guard('provider')->id())->first();
        $contract = new Contract();

        $contract->amount = $request->amount; 
        $contract->coverage =  $contract_type;
        $provider->contract()->save($contract);
        
        return redirect()->route('underwriter.home');
    }

    public function createContract($contract_type)
    {
        return view('provider/createContract',  ['contract_type' => $contract_type]);
    }
}
