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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

Route::get('/', function () {
    if (Auth::check()) {
        return Redirect::to('/admin/dashboard');
    }

    return view('common.home.index');
});
Route::get('/merchant/help', 'HomeController@help');

Route::get('/login', 'LoginController@login');
Route::post('/login/check', 'LoginController@loginCheck');

//Merchant Login
Route::get('/merchant/login', 'MerchantController@merchantLogin');
Route::post('/merchant/login-check', 'MerchantController@merchantLoginCheck');

Route::get('/merchant/registration', 'MerchantController@registration');
Route::get('/merchant/forgot-password', 'MerchantController@forgotpassword');
Route::post('/merchant/password-reset', 'MerchantController@resetpassword');
Route::get('/merchant/confirm-password/{id}', 'MerchantController@confirmpassword');
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
    // Parcel Type Route
    Route::get('/admin/parceltypes/create', 'ParcelTypeController@create');
    Route::get('/admin/parceltypes/view', 'ParcelTypeController@show');
    Route::post('/admin/parceltypes/store', 'ParcelTypeController@store');
    Route::get('/admin/parceltypes/edit/{id}', 'ParcelTypeController@edit');
    Route::post('/admin/parceltypes/update', 'ParcelTypeController@update');
    Route::get('/admin/parceltypes/delete/{id}', 'ParcelTypeController@destroy');
    // Customer Route
    Route::get('/customer/create', 'CustomerController@create');
    Route::post('/customer/store', 'CustomerController@store');
    Route::get('/customer/edit/{id}', 'CustomerController@edit');
    Route::post('/customer/update', 'CustomerController@update');
    Route::get('/customer/delete/{id}', 'CustomerController@delete');
    // Delivery Man Route
    Route::get('/admin/deliveryman/create', 'DeliveryManController@create');
    Route::get('/admin/deliverymans', 'DeliveryManController@show');
    Route::get('/admin/deliveryman/tarck', 'DeliveryManController@locationtrack');
    Route::post('/deliveryman-all/change', 'AdminController@deliverymanChange');
    Route::post('/admin/deliveryman/store', 'DeliveryManController@store');
    Route::get('/admin/deliveryman/edit/{id}', 'DeliveryManController@edit');
    Route::post('/admin/deliveryman/update', 'DeliveryManController@update');
    Route::get('/admin/deliveryman/delete/{id}', 'DeliveryManController@destroy');
    Route::get('/admin/deliveryman/inactive/{id}', 'AdminController@deliverymanInactive');
    Route::get('/admin/deliveryman/activate/{id}', 'AdminController@deliverymanActivate');


    Route::get('/admin/view/payments-request', 'PaymentController@adminPayment');
    Route::get('/admin/view/payments-request/approve/{id}', 'PaymentController@adminPaymentApprove');
    Route::get('/admin/view/payments-request/cancel/{id}', 'PaymentController@adminPaymentCancel');
    Route::post('/paymentrequest-all/change', 'PaymentController@PaymentRequestChange');


    Route::get('/admin/parcel/show', 'ParcelController@adminParcelShow');
    Route::get('/admin/parcel/details/{id}', 'ParcelController@adminParceldetails');
    Route::get('/admin/parcel/assign-deliveryman', 'ParcelController@adminAssignDeliveryMan');
    Route::get('/admin/parcel/receive-by-admin', 'ParcelController@productReceiveByAdmin');

    Route::get('/admin/setting', 'ParcelController@adminhtml');
    Route::post('/merchant-all/change', 'AdminController@changeMerchant');
    Route::post('/same-day/serach', 'AdminController@sameDaySearch');
    Route::post('/next-day/serach', 'AdminController@nextDaySearch');
    Route::post('/invoice/serach', 'AdminController@invoiceSearch');
    Route::post('/area/serach', 'AdminController@areaSearch');
});

Route::group(['middleware' => 'admin'], function () {

    Route::get('/logout', 'DashboardController@logout');

});

Route::group(['middleware' => 'merchant'], function () {

    Route::get('/merchant/parcels/{day}', 'ParcelController@index');
    Route::post('/merchant/parcel/store', 'ParcelController@store');
    Route::get('/merchant/parcel/show', 'ParcelController@show');
    Route::get('/merchant/parcel/details/{id}', 'ParcelController@details');
    Route::get('/merchant/parcel/edit/{id}', 'ParcelController@edit');
    Route::post('/merchant/parcel/update', 'ParcelController@update');
    Route::get('/merchant/parcel/delete/{id}', 'ParcelController@destroy');
    Route::post('/same-day/serach', 'ParcelController@sameDaySearch');
    Route::post('/next-day/serach', 'ParcelController@nextDaySearch');
    Route::post('/invoice/serach', 'ParcelController@invoiceSearch');
    Route::post('/parcel-all/change', 'ParcelController@deleleParcel');


    Route::get('/merchant/dashboard', 'MerchantController@dashboard');
    Route::get('/merchant/profile/setting', 'MerchantController@merchantSetting');
    Route::get('/merchant/setting/edit/{id}', 'MerchantController@edit');
    Route::post('/merchant/setting/update', 'MerchantController@update');


    Route::get('/merchant/payments', 'PaymentHistoryController@merchantPayments');
    Route::any('/merchant/payments/request', 'PaymentHistoryController@paymentRequest');
    Route::post('/merchant/payments/store', 'PaymentHistoryController@paymentStore');
    Route::get('/merchant/payments/view', 'PaymentHistoryController@show');

    //shop manage
    Route::get('/merchant/shop/create', 'ShopController@index');
    Route::get('/merchant/shop/view', 'ShopController@show');
    Route::post('/merchant/shop/store', 'ShopController@store');
    Route::get('/merchant/shop/edit/{id}', 'ShopController@edit');
    Route::post('/merchant/shop/update', 'ShopController@update');
    Route::get('/merchant/shop/delete/{id}', 'ShopController@destroy');
    //PaymentMathoed manage
    Route::get('/merchant/paymentmethoed/create', 'PaymentMEthoedController@index');
    Route::get('/merchant/paymentmethoed/view', 'PaymentMEthoedController@show');
    Route::post('/merchant/paymentmethoed/store', 'PaymentMEthoedController@store');
    Route::get('/merchant/paymentmethoed/edit/{id}', 'PaymentMEthoedController@edit');
    Route::post('/merchant/paymentmethoed/update', 'PaymentMEthoedController@update');
//    Route::get('/merchant/paymentmethoed/delete/{id}', 'PaymentMEthoedController@destroy');

    Route::get('/merchant/current/shop', 'ShopController@merchantCurrentShop');

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

    return \App\ParcelType::where('parcel_type_id', $request['id'])->first();

});


Route::get('/statistics', function () {


    $par_count = Parcel::
    where('parcels.merchant_id', Auth::guard('merchant')->id())
        ->count();
    $delivery_pending = Parcel::join('parcel_statuses', 'parcel_statuses.parcel_id', '=', 'parcels.parcel_id')
        ->where('parcels.merchant_id', Auth::guard('merchant')->id())
        ->where('parcel_statuses.delivery_status', 'pending')->count();
    $delivery_accepted = Parcel::join('parcel_statuses', 'parcel_statuses.parcel_id', '=', 'parcels.parcel_id')
        ->where('parcels.merchant_id', Auth::guard('merchant')->id())
        ->where('parcel_statuses.delivery_status', 'accepted')->count();
    $delivery_cancelled = Parcel::join('parcel_statuses', 'parcel_statuses.parcel_id', '=', 'parcels.parcel_id')
        ->where('parcels.merchant_id', Auth::guard('merchant')->id())
        ->where('parcel_statuses.delivery_status', 'cancelled')->count();
    $delivery_on_the_way = Parcel::join('parcel_statuses', 'parcel_statuses.parcel_id', '=', 'parcels.parcel_id')
        ->where('parcels.merchant_id', Auth::guard('merchant')->id())
        ->where('parcel_statuses.delivery_status', 'on_the_way')->count();
    $delivery_delivered = Parcel::join('parcel_statuses', 'parcel_statuses.parcel_id', '=', 'parcels.parcel_id')
        ->where('parcels.merchant_id', Auth::guard('merchant')->id())
        ->where('parcel_statuses.delivery_status', 'delivered')->count();
    $delivery_returned = Parcel::join('parcel_statuses', 'parcel_statuses.parcel_id', '=', 'parcels.parcel_id')
        ->where('parcels.merchant_id', Auth::guard('merchant')->id())
        ->where('parcel_statuses.delivery_status', 'returned')->count();

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


