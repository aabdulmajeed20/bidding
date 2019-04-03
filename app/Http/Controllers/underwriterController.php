<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Provider;
use Auth;

class underwriterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:provider');
    }
    
    public function home()
    { 
        $id = Provider::find(Auth::guard('provider')->id())->name;
        return view('provider/home', ['id' => $id]);
    }

    public function AllBidding()
    {
        # Check if usser has contract or not?!...
        
        return view('provider/allBidding');
    }

    public function contractOption()
    {
        return view('provider/contractOption');
    }
}
