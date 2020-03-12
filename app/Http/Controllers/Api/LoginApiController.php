<?php

namespace App\Http\Controllers\Api;

use App\DeliveryMan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginApiController extends Controller
{
    //



    public function login(Request $request){

        $status_code=200;
        $message="Logged in";
        $access_token="ABC";
        $data=null;


        $credentials = [
            'delivery_man_phone'=>$request['phone_number'],
            'password'=>$request['password'],
        ];


        if (Auth::guard('deliveryman')->attempt($credentials)) {
            $data= Auth::guard('deliveryman')->user();

        } else {

            $status_code=400;
            $message="Phone number or Password is wrong.";
        }

        return [
            'status_code'=>$status_code,
            'message'=>$message,
            'access_token'=>$access_token,
            'data'=>$data,
        ];
    }
}
