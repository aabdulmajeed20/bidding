<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('/login', [
    'uses' => 'HomeController@login',
    'as' => 'login'
]);
Route::get('/getLogin', [
    'uses' => 'HomeController@getLogin',
    'as' => 'getLogin'
]);

Route::get('/bidding', function () {
    return view('bidding');
});

Route::get('/addBidding', function () {
    return view('addBidding');
});

Route::get('/biddingHistory', function () {
    return view('biddingHistory');
});

Route::get('/test', function () {
    return view('test');
});
Route::get('/testApi', 'HomeController@testApi');

Route::get('/home', [
    'uses' => 'HomeController@home',
    'as' => 'home'
]);