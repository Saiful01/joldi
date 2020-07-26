<?php

namespace App\Http\Controllers\Api;

use App\DeliveryMan;
use App\Http\Controllers\Controller;
use App\Parcel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginApiController extends Controller
{
    //


    public function login(Request $request)
    {

        $status_code = 200;
        $message = "Logged in";
        $access_token = "ABC";
        $data = null;


        $credentials = [
            'delivery_man_phone' => $request['phone_number'],
            'password' => $request['password'],
        ];


        if (Auth::guard('deliveryman')->attempt($credentials)) {
            $data = Auth::guard('deliveryman')->user();

            if (!Auth::guard('deliveryman')->user()->active_status) {
                $status_code = 400;
                $message = "Your account is not activated.";
            }


        } else {

            $status_code = 400;
            $message = "Phone number or Password is wrong.";
        }

        $delivery_pending = Parcel::join('parcel_statuses', 'parcel_statuses.parcel_id', '=', 'parcels.parcel_id')
            ->where('parcel_statuses.delivery_man_id', Auth::guard('deliveryman')->id())
            ->where('parcel_statuses.delivery_status', 'pending')->count();


        return [
            'status_code' => $status_code,
            'message' => $message,
            'access_token' => $access_token,
            'pending_order' => $delivery_pending,
            'data' => $data,
        ];
    }

    public function registration(Request $request)
    {

        $status_code = 200;
        $message = "Logged in";
        $access_token = "ABC";
        $data = null;


        $credentials = [
            'delivery_man_phone' => $request['phone_number'],
            'password' => $request['password'],
        ];

        $data = array(
            'delivery_man_name' => $request['username'],
            'delivery_man_email' => $request['email'],
            'delivery_man_phone' => $request['phone'],
            'password' => Hash::make($request['password']),
            'delivery_man_address' => $request['address'],
            'delivery_man_type' => $request['type'],
        );

        try {
            DeliveryMan::create($data);
            $status_code = 200;
            $message = "Registration successful";
        } catch (\Exception $exception) {

            $status_code = 200;
            $message = $exception->getMessage();
        }


        return [
            'status_code' => $status_code,
            'message' => $message,
            'access_token' => $access_token,
            'data' => $data,
        ];
    }

    public function resetPassword(Request $request)
    {

        $status_code = 200;
        $message = "Logged in";
        $access_token = "ABC";
        $data = null;


        //Reset

        /*     try {
                 $status_code = 200;
                 $message = "Registration successful";
             } catch (\Exception $exception) {

                 $status_code = 200;
                 $message = $exception->getMessage();
             }*/


        return [
            'status_code' => $status_code,
            'message' => $message,
            'access_token' => $access_token,
            'data' => $data,
        ];
    }
}
