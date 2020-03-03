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

use App\Parcel;
use App\ParcelStatus;
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

//$1+t;JRljtz2
//
//User: pixonlab_parcel
//
//Database: pixonlab_e-parcel


Route::group(['middleware' => 'admin'], function () {
    Route::get('/admin/dashboard', 'DashboardController@dashboard');
    Route::get('/admin/parcels', 'ParcelController@index');
    Route::post('/parcel/store', 'ParcelController@store');
    Route::get('/parcel/view', 'ParcelController@view');
    Route::get('/parcel/edit/{{id}}', 'ParcelController@edit');
    Route::post('/parcel/update', 'ParcelController@update');
    Route::get('/parcel/delete/{{id}}', 'ParcelController@delete');

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


    Route::get('/admin/view/payments-request', 'PaymentController@adminPayment');
    Route::get('/admin/view/payments-request/approve/{id}', 'PaymentController@adminPaymentApprove');
    Route::get('/admin/view/payments-request/cancel/{id}', 'PaymentController@adminPaymentCancel');

});

Route::group(['middleware' => 'admin'], function () {

    Route::get('/logout', 'DashboardController@logout');

});

Route::group(['middleware' => 'merchant'], function () {

    Route::get('/merchant/dashboard', 'DashboardController@dashboard');
    Route::get('/merchant/parcel/show', 'ParcelController@show');
    Route::get('/merchant/payments', 'PaymentHistoryController@merchantPayments');
    Route::any('/merchant/payments/request', 'PaymentHistoryController@paymentRequest');
    Route::post('/merchant/payments/store', 'PaymentHistoryController@paymentStore');
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
Route::get('/statistics', function () {


    $par_count = Parcel::count();
    $delivery_pending = ParcelStatus::where('delivery_status', 'pending')->count();
    $delivery_accepted = ParcelStatus::where('delivery_status', 'accepted')->count();
    $delivery_cancelled = ParcelStatus::where('delivery_status', 'cancelled')->count();
    $delivery_on_the_way = ParcelStatus::where('delivery_status', 'on_the_way')->count();
    $delivery_delivered = ParcelStatus::where('delivery_status', 'delivered')->count();
    $delivery_returned = ParcelStatus::where('delivery_status', 'returned')->count();

    $payable_amount = Parcel::join('parcel_statuses', 'parcel_statuses.parcel_id', '=', 'parcels.parcel_id')
        ->where('is_complete', true)
        ->where('delivery_status', "delivered")
        ->where('is_paid_to_merchant', "pending")
        //->whereBetween('parcels.created_at', [$date_from->format('Y-m-d') . " 00:00:00", $date_to->format('Y-m-d') . " 23:59:59"])
        ->sum('payable_amount');

    $total_sales = Parcel::join('parcel_statuses', 'parcel_statuses.parcel_id', '=', 'parcels.parcel_id')
        ->where('is_complete', true)
        ->where('delivery_status', "delivered")
        ->where('is_paid_to_merchant', "pending")
        //->whereBetween('parcels.created_at', [$date_from->format('Y-m-d') . " 00:00:00", $date_to->format('Y-m-d') . " 23:59:59"])
        ->sum('total_amount');

    return [
        'par_count' => $par_count,
        'delivery_pending' => $delivery_pending,
        'delivery_accepted' => $delivery_accepted,
        'delivery_cancelled' => $delivery_cancelled,
        'delivery_on_the_way' => $delivery_on_the_way,
        'delivery_delivered' => $delivery_delivered,
        'delivery_returned' => $delivery_returned,
        'payable_amount' => $payable_amount,
        'total_sales' => $total_sales
    ];


});

