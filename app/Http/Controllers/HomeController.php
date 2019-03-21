<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Session;
use Cookie;
use App\User;
// use Auth;

class HomeController extends Controller
{
    public function home()
    {
        $client = new Client();
        $accessToken = Cookie::get('token');
        $res = $client->get('http://localhost/wallet/public/api/details', [
            'headers' =>  [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$accessToken,
                ]
            ]);
        $name = json_decode($res->getBody())->success->name;
        return view('home', ['name' => $name]);
    }

    public function postLogin()
    {
        Cookie::queue(Cookie::forget('XSRF-TOKEN'));
        Cookie::queue(Cookie::forget('laravel_session'));
        $client = new Client();
        // dd(request('email'), request('password'));
        try {
            $res = $client->post('http://localhost/wallet/public/api/login', [
                'form_params' => [
                    'email' => request('email'),
                    'password' => request('password')
                ]
            ]);
        } catch (\Throwable $th) {
            return $th;
        }
        $token = json_decode($res->getBody())->success->token;
        $name = json_decode($res->getBody())->success->name;
        $email = json_decode($res->getBody())->success->email;
        $user = User::where('email', $email)->first();
        if(!$user){
            $user = new User();
            $user->name = $name;
            $user->email = $email;
            $user->remember_token = $token;
            $user->save();
        }
        Session::put('user_id', $user->id);
        // setcookie(, $token, time() + (86400 * 30), '/');
        Cookie::queue('token', $token, (86400 * 30));

        return redirect()->route('home');
        
    }

    public function login()
    {
        return view('login');
    }

    public function getBidding()
    {
        $user_id = Session::get('user_id');
        $user = User::where('_id', $user_id)->first();
        return view('bidding', ['user' => $user]);
    }

    public function logout()
    {
        Cookie::queue(
            Cookie::forget('token')
        );
        
        Session::forget('user_id');
        return view('welcome');
    }
}
