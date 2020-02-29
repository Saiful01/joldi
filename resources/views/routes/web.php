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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

Route::get('/', function () {
    if (Auth::check()) {
        return Redirect::to('/admin/dashboard');
    }

    return view('common.home.index');
});





Route::get('/login', 'LoginController@login');
Route::post('/login/check', 'LoginController@loginCheck');

Route::get('/registration', 'RegistrationController@registration');
Route::post('/merchant/create', 'RegistrationController@store');


Route::group(['middleware' => 'admin'], function () {
    Route::get('/admin/dashboard', 'DashboardController@dashboard');
    Route::get('/admin/parcels', 'ParcelController@show');

    //merchant
    Route::post('/merchant/store', 'MerchantController@store');

    // Customer Route
    Route::get('/customer/create', 'CustomerController@create');
    Route::post('/customer/store', 'CustomerController@store');
    Route::get('/customer/edit/{id}', 'CustomerController@edit');
    Route::post('/customer/update', 'CustomerController@update');
    Route::get('/customer/delete/{id}', 'CustomerController@delete');



});

Route::group(['middleware' => 'admin'], function () {

    Route::get('/logout', 'DashboardController@logout');

});


Route::get('/jjjj', function () {


    return view('common.home.index');
});

Route::get('/test', function () {

    return $credentials = [
        'merchant_phone' => "420",
        'merchant_password' => "420",
    ];


    if (Auth::guard('merchant')->attempt($credentials,true)) {
        return "success";

        //return Auth::guard('writer')->user()->writer_id;

    } else {

        return "failed";
    }
});


