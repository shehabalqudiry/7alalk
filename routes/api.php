<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

#####################users############################
Route::group(['namespace' => 'API\Auth'], function () {
    Route::post('signup-user', 'UserController@signup');
    Route::post('verify-Phone', 'UserController@verify');
    Route::post('Add-Location', 'UserController@addlocation');
    Route::get('Data-Edit-User', 'UserController@dataedituser');
    Route::post('Edit-Profile', 'UserController@editprofile');
    Route::get('Make-Faq','UserController@makefaq');
    Route::post('Make-Order-Check','UserController@makeordercheck');
});

####################APIS#######################
Route::group(['namespace' => 'API'], function () {
    Route::post('login','ApiController@logins');
    Route::get('Get-Regions','ApiController@regions');
    Route::get('Get-Countries','ApiController@Countries');
    Route::get('Get-Animals','ApiController@animals');
    Route::get('Get-Cat','ApiController@cats');
    Route::get('Get-SubCat/{id}','ApiController@subcats');
    Route::get('Faqs','ApiController@faqs');
});
