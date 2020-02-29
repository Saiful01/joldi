<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    public function _construct()
    {
         /*return "lol";
         $this->middleware(function ($request, $next) {
             if (Auth::check()) {
                 return "lol";
                 return Redirect::to('/admin/dashboard');
             }else{
                 return"hom";
             }
             return $next($request);
         });*/

    }

    public function login()
    {
        //return 0;
        return view('admin.login.index');
    }

    public function loginCheck(Request $request)
    {

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {

            return redirect()->intended('/admin/dashboard');
        }

        return Redirect::to('/login')
            ->with('failed','Email or password is wrong.')
            ->withInput();

    }

    public function test(){


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

    }
}
