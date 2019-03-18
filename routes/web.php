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

// the provider will bid
Route::get('/addBid', [
    'uses' => 'BidController@createBid',
    'as' => 'addBid'
]);

// will create the provider bidding
Route::post('/createBid', [
    'uses' => 'BidController@addBidding',
    'as' => 'createBid'
]);

Route::get('/biddingHistory', [
    'uses' => 'BidController@biddingHistory',
    'as' => 'biddingHistory'
]);

Route::get('/home', [
    'uses' => 'HomeController@home',
    'as' => 'home'
]);

Route::post('/logout', [
    'uses' => 'HomeController@logout',
    'as' => 'logout'
]);

Route::get('/bidDetails/{bid_id}', [
    'uses' => 'BidController@bidDetails',
    'as' => 'bidDetails'
]);