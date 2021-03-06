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
  if(Cookie::get('token')){
    if(Auth::guard('provider')->check()){
      return redirect()->route('allBidding');
    }else{
      return redirect()->action('HomeController@home');
    }
  }

    return view('welcome');
});

Route::post('/postLogin', [
    'uses' => 'HomeController@postLogin',
    'as' => 'postLogin'
]);

Route::get('/profile/{id}', function($id){
  dd(\App\Provider::where('_id', $id)->first());
})->name('profile');

Route::get('/login', [
    'uses' => 'HomeController@login',
    'as' => 'login'
]);

Route::get('/auth/{token}', [
    'uses' => 'HomeController@autoLogin',
    'as' => 'autoLogin'
]);

// the underwriter will bid
Route::get('/addIssuanceRequest', [
    'uses' => 'BidController@createBid',
    'as' => 'addBid'
]);

// will create the underwriter bidding
Route::post('/postIssuanceRequest', [
    'uses' => 'BidController@postBid',
    'as' => 'postBid'
]);

Route::get('/issuanceRequestsHistory', [
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

Route::get('/requestDetails/{bid_id}', [
    'uses' => 'BidController@bidDetails',
    'as' => 'bidDetails'
]);

Route::get('/buyOffer/{id}', [
    'uses' => 'OfferController@buyOffer',
    'as' => 'buyOffer'
]);

Route::prefix('underwriter')->group(function() {

    Route::get('/register', [
        'uses' => 'underwriterLoginController@register',
        'as' => 'register'
    ]);

    Route::post('/postRegister', [
        'uses' => 'underwriterLoginController@postRregister',
        'as' => 'underwriter.postRegister'
    ]);

    Route::get('/login', [
        'uses' => 'underwriterLoginController@login',
        'as' => 'underwriter.login'
    ]);

    Route::post('/postLogin', [
        'uses' => 'underwriterLoginController@postLogin',
        'as' => 'underwriter.postLogin'
    ]);
    Route::post('/logout', [
        'uses' => 'underwriterLoginController@getLogout',
        'as' => 'underwriter.logout'
    ]);

    Route::get('/home', [
        'uses' => 'underwriterController@home',
        'as' => 'underwriter.home'
    ]);

    Route::get('/allRequests', [
        'uses' => 'BidController@allBidding',
        'as' => 'allBidding'
    ]);

    Route::post('/requestDetails/{bid_id}/addOffer', [
        'uses' => 'OfferController@addOffer',
        'as' => 'addOffer'
    ]);

    Route::get('/requestDetails/{bid_id}/createOffer', [
        'uses' => 'OfferController@createOffer',
        'as' => 'createOffer'
    ]);

    Route::get('/contractOption', [
        'uses' => 'ContractController@contractOption',
        'as' => 'contractOption'
    ]);

    Route::get('/createContract', [
        'uses' => 'ContractController@createContract',
        'as' => 'createContract'
    ]);

    Route::match(array('GET','POST'), '/addContract', [
        'uses' => 'ContractController@addContract',
        'as' => 'addContract'
    ]);
});
