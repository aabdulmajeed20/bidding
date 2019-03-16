<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class HomeController extends Controller
{
    public function login()
    {

        return view('login');
    }

    public function getlogin()
    {
        return view('bidding');
    }

    public function testApi()
    {
        $client = new Client();
        $res = $client->post('http://localhost/wallet/public/api/details', ['form_params' =>  ['email' =>'aabdulmajeed16@gmail.com', 'password' => '456789123']]);
        // echo $res->getStatusCode(); // 200
        echo $res->getBody('token');
        // return $res;
    }
}
