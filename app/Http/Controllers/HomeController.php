<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Session;
use Cookie;

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

    public function login()
    {
        $client = new Client();
        $res = $client->post('http://localhost/wallet/public/api/login', [
            'form_params' => [
                'email' => request('email'),
                'password' => request('password')
            ]
        ]);
        $token = json_decode($res->getBody())->success->token;
        $name = json_decode($res->getBody())->success->name;
        Session::put('name',  $name);
        // setcookie(, $token, time() + (86400 * 30), '/');
        Cookie::queue('token', $token, (86400 * 30));

        return redirect()->route('home');
        // return $name;
    }

    public function getlogin()
    {
        return view('login');
    }

    public function logout()
    {
        Cookie::queue(
            Cookie::forget('token')
        );
        
        Session::forget('name');
        return "logout";
    }
}
