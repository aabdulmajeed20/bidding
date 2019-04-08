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

    public function addContract(Request $request)
    {
        $provider = Provider::find(Auth::guard('provider')->id())->first();
        $contract = new Contract();

        $contract->amount = $request->amount; 
        $contract->remaining_balance = $request->amount;
        $provider->contract_number = mt_rand(1000000000, 9999999999);
        $provider->contract()->save($contract);

        return redirect()->route('underwriter.home');
    }

    public function createContract()
    {
        return view('provider/createContract');
    }
}
