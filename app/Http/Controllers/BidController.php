<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Provider;

class BidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function biddingHistory()
    {  
        return view('biddingHistory');
    }

}
