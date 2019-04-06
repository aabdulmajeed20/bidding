<?php

namespace App\CBX;

//use Illuminate\Support\ServiceProvider;

class Currency {

     static function convert($from, $to){

      $req = @file_get_contents('https://free.currencyconverterapi.com/api/v6/convert?q='.$from.'_'.$to.'&compact=ultra&apiKey='. env("currencyconverterapi"));
      $price = json_decode($req, true);

      if($price == 'null'){
        return 'OFFLINE';
      }
      return $price[$from.'_'.$to];
    }

    static function getPrice($to, $amount){

     $cbxPrice = 2.00;
     $convertedPrice = Currency::convert('USD', $to, $amount);
     $finalMarketPrice = $convertedPrice * $cbxPrice;
     //return $finalMarketPrice;
     $amount = floatval($amount * floatval($finalMarketPrice));
     return floatval($amount);
   }
}
