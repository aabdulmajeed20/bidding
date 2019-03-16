<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class HomeController extends Controller
{
    public function home()
    {
        $client = new Client();
        $accessToken = $_COOKIE['token'];
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
        setcookie('token', $token, time() + (86400 * 30), '/');
        return redirect()->route('home');
        // return $name;
    }

    public function getlogin()
    {
        return view('login');
    }

    public function testApi()
    {
        $client = new Client();
        $accessToken = $_COOKIE['token'];
        $res = $client->get('http://localhost/wallet/public/api/details', [
            'headers' =>  [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$accessToken,
                ]
            ]);
        $email = json_decode($res->getBody());
        return $email->success->email;
        // return $res;
    }
}
