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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::any('/login', 'Api\LoginApiController@login');

Route::post('/parcels', 'Api\ParcelApiController@getParcel');
Route::post('/parcel-details', 'Api\ParcelApiController@getParcelDetails');
Route::post('/parcel-update', 'Api\ParcelApiController@parcelUpdate');

Route::post('/parcel/tracking', 'Api\ParcelApiController@parcelTracking');

