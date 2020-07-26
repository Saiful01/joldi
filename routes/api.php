<?php

use Illuminate\Http\Request;

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


//Token : eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::any('/login', 'Api\LoginApiController@login');
Route::post('/reset-password', 'Api\LoginApiController@resetPassword');
Route::any('/registration', 'Api\LoginApiController@registration');

Route::post('/pending-collection', 'Api\ParcelApiController@getCololectableParcel');
Route::post('/parcel-collect', 'Api\ParcelApiController@collectParcel');

Route::post('/parcels', 'Api\ParcelApiController@getParcel');
Route::post('/parcel-details', 'Api\ParcelApiController@getParcelDetails');
Route::post('/parcel-update', 'Api\ParcelApiController@parcelUpdate');

Route::post('/parcel/tracking', 'Api\ParcelApiController@parcelTracking');
Route::post('/partial-deliver/store', 'Api\ParcelApiController@partialDeliverStore');
Route::post('/return-deliver/store', 'Api\ParcelApiController@returnDeliverStore');

Route::post('/report', 'Api\ParcelApiController@report');




Route::any('/location/store', 'Api\ParcelApiController@locationStore');
Route::any('/location/get', 'Api\ParcelApiController@locationGet');

