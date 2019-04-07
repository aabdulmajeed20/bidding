<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Provider;
use Auth;
use Session;

class underwriterLoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest:provider', ['except' => ['getLogout']]);
    }
    public function register()
    {
        return view('provider/register');
    }
    public function postRregister()
    {
        //dd(request()->all());
        $provider = new Provider();
        $provider->name = request('name');
        $provider->email = request('email');
        $provider->cover = request('cover');
        $provider->currency = request('currency');
        $provider->password = bcrypt(request('password'));
        $provider->save();

        return redirect()->route('allBidding');
    }
    public function login()
    {
        return view('provider/login');
    }
    public function postLogin()
    {
        if(Auth::guard('provider')->attempt(['email' => request('email'), 'password' => request('password')])) {

            $provider_id = Auth::guard('provider')->id();
            // dd($provider_id);
            Session::put("provider_id", $provider_id);

            return redirect()->route('underwriter.home');
        }
        return 'Failed Login';
    }

    public function getLogout()
    {
        Auth::guard('provider')->logout();
        return redirect()->route('underwriter.login');
    }
}
