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
Route::any('/merchant/store', 'RegistrationController@store');


Route::group(['middleware' => 'admin'], function () {
    Route::get('/admin/dashboard', 'DashboardController@dashboard');
    Route::get('/admin/parcels', 'ParcelController@index');
    Route::post('/parcel/store', 'ParcelController@store');
    Route::get('/parcel/view', 'ParcelController@view');

    //merchant
//    Route::post('/merchant/store', 'MerchantController@store');

    // Customer Route
    Route::get('/customer/create', 'CustomerController@create');
    Route::post('/customer/store', 'CustomerController@store');
    Route::get('/customer/edit/{id}', 'CustomerController@edit');
    Route::post('/customer/update', 'CustomerController@update');
    Route::get('/customer/delete/{id}', 'CustomerController@delete');
    // Delivery Man Route
    Route::get('/deliveryman/create', 'DeliveryManController@create');
    Route::post('/deliveryman/store', 'DeliveryManController@store');
    Route::get('/deliveryman/edit/{id}', 'DeliveryManController@edit');
    Route::post('/deliveryman/update', 'DeliveryManController@update');
    Route::get('/deliveryman/delete/{id}', 'DeliveryManController@delete');



});

Route::group(['middleware' => 'admin'], function () {

    Route::get('/logout', 'DashboardController@logout');

});

Route::group(['middleware' => 'merchant'], function () {

    Route::get('/merchant/dashboard', 'DashboardController@dashboard');
    Route::get('/merchant/parcel/show', 'ParcelController@show');
    Route::get('/merchant/payments', 'PaymentHistoryController@merchantPayments');
    Route::get('/merchant/payments/view', 'PaymentHistoryController@show');



    Route::get('/logout', 'DashboardController@logout');

});






Route::get('/merchant-test', function () {



     $credentials = [
        'merchant_phone' => "66",
        'password' => "1234",
    ];

    if (Auth::guard('merchant')->attempt($credentials)) {
        return "success";
        //return Auth::guard('writer')->user()->writer_id;

    } else {

        return "failed";
    }
});

//API
Route::get('/angular', function () {

    return \App\ParcelType::get();

});


