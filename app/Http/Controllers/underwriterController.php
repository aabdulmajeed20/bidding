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
}
