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
    //get user details
    public function home()
    {
        $client = new Client();
        $accessToken = Cookie::get('token');

          $res = $client->get('http://'.env('CBX_API').'/api/details', [
              'headers' =>  [
                  'Accept' => 'application/json',
                  'Authorization' => 'Bearer '.$accessToken,
                ],
                'exceptions' => false,
              ]);

        if($res->getStatusCode() == 401){
          return redirect()->route('login');
        }
        if(!Session::get('user_id')){
          $token = $accessToken;
          $firstname = json_decode($res->getBody())->success->firstname;
          $lastname = json_decode($res->getBody())->success->lastname;
          $email = json_decode($res->getBody())->success->email;
          $user = User::where('email', $email)->first();

              if(!$user){
                  $user = new User();
                  $user->firstname = $firstname;
                  $user->lastname = $lastname;
                  $user->email = $email;
                  $user->remember_token = $token;
                  $user->save();
              }

          Session::put('user_id', $user->id);
          }

        return view('home');
    }
    public function autoLogin($token)
    {
        $client = new Client();

        $accessToken = base64_decode($token);

        $res = $client->get('http://'.env('CBX_API').'/api/details', [
            'headers' =>  [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$accessToken,
                ]
            ]);

        $token = $accessToken;
        $firstname = json_decode($res->getBody())->success->firstname;
        $lastname = json_decode($res->getBody())->success->lastname;
        $email = json_decode($res->getBody())->success->email;
        $user = User::where('email', $email)->first();

            if(!$user){
                $user = new User();
                $user->firstname = $firstname;
                $user->lastname = $lastname;
                $user->email = $email;
                $user->remember_token = $token;
                $user->save();
            }

        Session::put('user_id', $user->id);
        Cookie::queue('token', $token, (86400 * 30));

        return redirect()->route('home');
    }
    public function postLogin()
    {
        $client = new Client();
        // dd(request('email'), request('password'));
        try {
            $res = $client->post('http://'.env('CBX_API').'/api/login', [
                'form_params' => [
                    'email' => request('email'),
                    'password' => request('password')

                ]
            ]);
        } catch (\Throwable $th) {
            return $th;
        }
        $token = json_decode($res->getBody())->success->token;
        $firstname = json_decode($res->getBody())->success->firstname;
        $lastname = json_decode($res->getBody())->success->lastname;
        $email = json_decode($res->getBody())->success->email;
        $user = User::where('email', $email)->first();
        if(!$user){
            $user = new User();
            $user->firstname = $firstname;
            $user->lastname = $lastname;
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
