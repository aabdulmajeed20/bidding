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

Route::post('/postLogin', [
    'uses' => 'HomeController@postLogin',
    'as' => 'postLogin'
]);

Route::get('/login', [
    'uses' => 'HomeController@login',
    'as' => 'login'
]);


// the provider will bid
Route::get('/addBid', [
    'uses' => 'BidController@createBid',
    'as' => 'addBid'
]);

// will create the provider bidding
Route::post('/postBid', [
    'uses' => 'BidController@postBid',
    'as' => 'postBid'
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
Route::get('/allBidding', [
    'uses' => 'BidController@allBidding',
    'as' => 'allBidding'
]);


Route::post('add','BidController@store');

Route::prefix('provider')->group(function() {
    
    Route::get('/register', [
        'uses' => 'ProviderLoginController@register',
        'as' => 'register'
    ]);
    Route::post('/postRegister', [
        'uses' => 'ProviderLoginController@postRregister',
        'as' => 'provider.postRegister'
    ]);
    Route::get('/login', [
        'uses' => 'ProviderLoginController@login',
        'as' => 'provider.login'
    ]);
    Route::post('/postLogin', [
        'uses' => 'ProviderLoginController@postLogin',
        'as' => 'provider.postLogin'
    ]);
    Route::get('/logout', [
        'uses' => 'ProviderLoginController@getLogout',
        'as' => 'provider.logout'
    ]);
    Route::get('home', [
        'uses' => 'ProviderController@home',
        'as' => 'provider.home'
    ]);
    
}); 

