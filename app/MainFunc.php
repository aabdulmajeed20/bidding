<?php

namespace App;

use Auth;

class MainFunc {

     static function getBalance(){
       $id = Provider::where('_id', Auth::guard('provider')->id())->first();

       $contract = Contract::where('provider_id', $id->id)->first();

       if(isset($contract->amount) && $contract->amount !== null){
         return $contract->remaining_balance;
       }

      return False;
    }

}
