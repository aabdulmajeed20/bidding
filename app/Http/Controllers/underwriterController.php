<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Provider;
use App\Contract;
use App\MainFunc;

use Auth;

class underwriterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:provider');
    }

    public function home()
    {
        $id = Provider::where('_id', Auth::guard('provider')->user()->id)->first();
        return view('provider/home', ['id' => $id->name]);
    }
}
