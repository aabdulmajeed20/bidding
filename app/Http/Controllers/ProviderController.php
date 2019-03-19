<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Provider;
use Auth;

class ProviderController extends Controller
{
    public function register()
    {
        return view('provider/register');
    }
    public function postRregister()
    {
        $provider = new Provider();
        $provider->name = request('name');
        $provider->email = request('email');
        $provider->password = bcrypt(request('password'));
        $provider->save();

        return view('welcome');
    }
    public function login()
    {
        return view('provider/login');
    }
    public function postLogin()
    {
        if(Auth::guard('provider')->attempt(['email' => request('email'), 'password' => request('password')])) {
            $provider_id = Auth::guard('provider')->id();
            dd($provider_id);
            session()->put("provider_id", $provider_id);
            return redirect()->route('provider.home');
        }
        return 'Failed Login';
    }
    public function home()
    {
        return view('provider/home');
    }
}
