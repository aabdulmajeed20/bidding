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


Route::get('/bidding', [
    'uses' => 'HomeController@getBidding',
    'as' => 'bidding'
]);

Route::get('/addBidding', function () {
    return view('addBidding');
});

Route::get('/biddingHistory', [
    'uses' => 'BidController@index',
    'as' => 'biddingHistory'
]);

Route::get('/test', function () {
    return view('test');
});

Route::get('/testApi', 'HomeController@testApi');

Route::get('/home', [
    'uses' => 'HomeController@home',
    'as' => 'home'
]);

Route::post('/logout', [
    'uses' => 'HomeController@logout',
    'as' => 'logout'
]);


// for test 
Route::get('/add', [
    'uses' => 'BidController@create',
    'as' => 'add'
]);

Route::post('add','BidController@store');

Route::prefix('provider')->group(function() {
    
    Route::get('/register', [
        'uses' => 'ProviderController@register',
        'as' => 'register'
    ]);
    Route::post('/postRegister', [
        'uses' => 'ProviderController@postRregister',
        'as' => 'provider.postRegister'
    ]);
    Route::get('/login', [
        'uses' => 'ProviderController@login',
        'as' => 'provider.login'
    ]);
    Route::post('/postLogin', [
        'uses' => 'ProviderController@postLogin',
        'as' => 'provider.postLogin'
    ]);
    
}); 

