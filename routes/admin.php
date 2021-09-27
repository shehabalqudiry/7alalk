<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

define('PAGINATION_COUNT',10);
/*Route::group( [ 'prefix' => 'LaravelLocalization'::setLocale(),
'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ] ],function(){ */

Route::group(['namespace' => 'Admin', 'middleware' => 'auth:admin'], function () {
Route::post('/Send-Messages', 'DashboardController@sendmessages')->name('admin.send.messages');
Route::post('/Add-Bank', 'DashboardController@addbank')->name('admin.add.bank');
    Route::get('/', 'DashboardController@index')->name('admin.dashboard');
    Route::get('/Editprofile', 'DashboardController@editprofile')->name('admin.editprofile');
    Route::post('/updateprofile/{id}', 'DashboardController@updateprofile')->name('admin.updateprofile');
    Route::post('/logout', 'DashboardController@logout')->name('admin.logout');


    ######################### Begin cats Routes ########################
    Route::group(['prefix' => 'cats'], function () {
        Route::get('/','CatController@index') -> name('admin.cats');
        Route::get('create','CatController@create') -> name('admin.cats.create');
        Route::post('store','CatController@store') -> name('admin.cats.store');
        Route::get('edit/{id}','CatController@edit') -> name('admin.cats.edit');
        Route::post('update/{id}','CatController@update') -> name('admin.cats.update');
        Route::post('/Get-Sub-Cats','CatController@getsubcat') -> name('admin.cats.getsubcat');
        //Route::get('delete/{id}','CatController@destroy') -> name('admin.cats.delete');
    });
    ######################### End cats Routes  ########################
    ######################### Begin subcats Routes ########################
    Route::group(['prefix' => 'subcats'], function () {
        Route::get('/','SubCatController@index') -> name('admin.subcats');
        Route::get('create','SubCatController@create') -> name('admin.subcats.create');
        Route::post('store','SubCatController@store') -> name('admin.subcats.store');
        Route::get('edit/{id}','SubCatController@edit') -> name('admin.subcats.edit');
        Route::post('update/{id}','SubCatController@update') -> name('admin.subcats.update');
        //Route::get('delete/{id}','SubCatController@destroy') -> name('admin.subcats.delete');
    });
    ######################### End subcats Routes  ########################
    ######################### Begin animals Routes ########################
    Route::group(['prefix' => 'animals'], function () {
        Route::get('/','AnimalsController@index') -> name('admin.animals');
        Route::get('create','AnimalsController@create') -> name('admin.animals.create');
        Route::post('store','AnimalsController@store') -> name('admin.animals.store');
        Route::get('edit/{id}','AnimalsController@edit') -> name('admin.animals.edit');
        Route::post('update/{id}','AnimalsController@update') -> name('admin.animals.update');
        //Route::get('delete/{id}','AnimalsController@destroy') -> name('admin.animals.delete');
    });
    ######################### End animals Routes  ########################
    ######################### Begin countries Routes ########################
    Route::group(['prefix' => 'countries'], function () {
    Route::get('/','CounteryController@index') -> name('admin.countries');
    Route::get('create','CounteryController@create') -> name('admin.countries.create');
    Route::post('store','CounteryController@store') -> name('admin.countries.store');
    Route::get('edit/{id}','CounteryController@edit') -> name('admin.countries.edit');
    Route::post('update/{id}','CounteryController@update') -> name('admin.countries.update');
    //Route::get('delete/{id}','CounteryController@destroy') -> name('admin.countries.delete');
});
######################### End countries Routes  ########################
    ######################### Begin regions Routes ########################
    Route::group(['prefix' => 'regions'], function () {
        Route::get('/','RegionConroller@index') -> name('admin.regions');
        Route::get('create','RegionConroller@create') -> name('admin.regions.create');
        Route::post('store','RegionConroller@store') -> name('admin.regions.store');
        Route::get('edit/{id}','RegionConroller@edit') -> name('admin.regions.edit');
        Route::post('update/{id}','RegionConroller@update') -> name('admin.regions.update');
        //Route::get('delete/{id}','RegionConroller@destroy') -> name('admin.regions.delete');
    });
    ######################### End regions Routes  ########################
    ######################### Begin faqs Routes ########################
    Route::group(['prefix' => 'faqs'], function () {
        Route::get('/','FaqConroller@index') -> name('admin.faqs');
        Route::get('/orders','FaqConroller@orders') -> name('admin.orders');
        Route::get('create','FaqConroller@create') -> name('admin.faqs.create');
        Route::post('store','FaqConroller@store') -> name('admin.faqs.store');
        Route::get('edit/{id}','FaqConroller@edit') -> name('admin.faqs.edit');
        Route::post('update/{id}','FaqConroller@update') -> name('admin.faqs.update');
        Route::get('delete/{id}','FaqConroller@destroy') -> name('admin.faqs.delete');
    });
    ######################### End faqs Routes  ########################

    ######################### Begin helpers Routes ########################
    Route::group(['prefix' => 'helpers'], function () {
        Route::get('/','HelpersAdminController@index') -> name('admin.helpers');
        Route::get('create','HelpersAdminController@create') -> name('admin.helpers.create');
        Route::post('store','HelpersAdminController@store') -> name('admin.helpers.store');
        Route::get('edit/{id}','HelpersAdminController@edit') -> name('admin.helpers.edit');
        Route::post('update/{id}','HelpersAdminController@update') -> name('admin.helpers.update');
        Route::get('delete/{id}','HelpersAdminController@destroy') -> name('admin.helpers.delete');
       // Route::get('changeStatus/{id}','HelperController@changeStatus') -> name('admin.helpers.status');
    });
    ######################### Begin users Routes ########################
    Route::group(['prefix' => 'users'], function () {
        Route::get('/user/{type}','UserController@index') -> name('admin.users');
        Route::get('create/{type}','UserController@create') -> name('admin.users.create');
        Route::post('store','UserController@store') -> name('admin.users.store');
        Route::get('edit/{id}','UserController@edit') -> name('admin.users.edit');
        Route::post('update/{id}','UserController@update') -> name('admin.users.update');
        Route::get('delete/{id}','UserController@destroy') -> name('admin.users.delete');
       // Route::get('changeStatus/{id}','UserController@changeStatus') -> name('admin.users.status');

    });
    ######################### End users Routes  ########################
    ######################### Begin products Routes ########################
    Route::group(['prefix' => 'products'], function () {
        Route::get('/','ProductController@index') -> name('admin.products');
        Route::get('create','ProductController@create') -> name('admin.products.create');
        Route::post('store','ProductController@store') -> name('admin.products.store');
        Route::get('edit/{id}','ProductController@edit') -> name('admin.products.edit');
        Route::post('update/{id}','ProductController@update') -> name('admin.products.update');
        Route::get('delete/{id}','ProductController@destroy') -> name('admin.products.delete');
       // Route::get('changeStatus/{id}','ProductController@changeStatus') -> name('admin.products.status');

    });
    ######################### End products Routes  ########################

});

Route::group(['namespace' => 'Admin', 'middleware' => 'guest:admin'], function () {
    Route::get('login', 'loginController@getLogin')->name('admin.login');
    Route::post('login', 'loginController@login')->name('admin.login');
});

//});


/*
1 - عرض طلبات كشف العيادات في لوحة الادمن
// 2 - عند اضافة كل دولة ازود انة يدخل سعر العملة بتاعتها بالريال
3 - اعمل روت انة يقدر يغير الباسورد فقط دا غير تعديل الملف الشخص
4 - اعمل اضافة عروض ويضيف لمين والمدة
5 - العيادات
6 - طلبات التحصين
7 - الاضافة الي سلة الشراء والمفضلة
8 - تقييم المنتج والاسئلة والاجابات وافضل اجابة ولايك وديس لايك للاجابات
*/
