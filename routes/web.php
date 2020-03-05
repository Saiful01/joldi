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

//Merchant Login
Route::get('/merchant/login', 'MerchantController@merchantLogin');
Route::post('/merchant/login-check', 'MerchantController@merchantLoginCheck');

Route::get('/merchant/registration', 'MerchantController@registration');
Route::any('/merchant/store', 'MerchantController@store');


Route::group(['middleware' => 'admin'], function () {


    Route::get('/admin/dashboard', 'DashboardController@dashboard');
    Route::get('/admin/merchants', 'AdminController@merchants');
    Route::get('/admin/merchant/edit/{id}', 'AdminController@merchantEdit');
    Route::post('/admin/merchant/update', 'AdminController@merchantUpdate');
    Route::get('/admin/merchant/profile/{id}', 'AdminController@merchantProfile');
    Route::get('/admin/merchant/inactive/{id}', 'AdminController@merchantInactive');
    Route::get('/admin/merchant/activate/{id}', 'AdminController@merchantActivate');


    //merchant
//    Route::post('/merchant/store', 'MerchantController@store');

    // Area Route
    Route::get('/admin/area/create', 'AreaController@create');
    Route::get('/admin/area/view', 'AreaController@show');
    Route::post('/admin/area/store', 'AreaController@store');
    Route::get('/admin/area/edit/{id}', 'AreaController@edit');
    Route::post('/admin/area/update', 'AreaController@update');
    Route::get('/admin/area/delete/{id}', 'AreaController@destroy');
    // Customer Route
    Route::get('/customer/create', 'CustomerController@create');
    Route::post('/customer/store', 'CustomerController@store');
    Route::get('/customer/edit/{id}', 'CustomerController@edit');
    Route::post('/customer/update', 'CustomerController@update');
    Route::get('/customer/delete/{id}', 'CustomerController@delete');
    // Delivery Man Route
    Route::get('/admin/deliveryman/create', 'DeliveryManController@create');
    Route::get('/admin/deliverymans', 'DeliveryManController@show');
    Route::post('/admin/deliveryman/store', 'DeliveryManController@store');
    Route::get('/admin/deliveryman/edit/{id}', 'DeliveryManController@edit');
    Route::post('/admin/deliveryman/update', 'DeliveryManController@update');
    Route::get('/admin/deliveryman/delete/{id}', 'DeliveryManController@destroy');


    Route::get('/admin/view/payments-request', 'PaymentController@adminPayment');
    Route::get('/admin/view/payments-request/approve/{id}', 'PaymentController@adminPaymentApprove');
    Route::get('/admin/view/payments-request/cancel/{id}', 'PaymentController@adminPaymentCancel');

});

Route::group(['middleware' => 'admin'], function () {

    Route::get('/logout', 'DashboardController@logout');

});

Route::group(['middleware' => 'merchant'], function () {

    Route::get('/merchant/parcels', 'ParcelController@index');
    Route::post('/merchant/parcel/store', 'ParcelController@store');
    Route::get('/merchant/parcel/show', 'ParcelController@show');
    Route::get('/merchant/parcel/details/{id}', 'ParcelController@details');
    Route::get('/merchant/parcel/edit/{id}', 'ParcelController@edit');
    Route::post('/merchant/parcel/update', 'ParcelController@update');
    Route::get('/merchant/parcel/delete/{id}', 'ParcelController@destroy');


    Route::get('/merchant/dashboard', 'MerchantController@dashboard');
    Route::get('/merchant/profile/setting', 'MerchantController@merchantSetting');


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
Route::get('/get-parcel-type', function () {

    return \App\ParcelType::get();

});
Route::get('/get-delivery-charge/{id}', function (\Illuminate\Http\Request $request) {

    return \App\ParcelType::where('parcel_type_id',$request['id'])->first();

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


