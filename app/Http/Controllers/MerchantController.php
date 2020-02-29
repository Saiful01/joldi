<?php

namespace App\Http\Controllers;

use App\Merchant;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class MerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        return view('admin.merchant.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//       $validator = Validator::make($request->all(),[
//           'merchant_name'=>'requierd',
//           'merchant_phone'=>'requierd',
//           'merchant_email'=>'requierd'
//
//       ]);
//       if ($validator->fails()){
//           return back()->with('Failed',"Check Reqiered Field");
//       }
//
//       unset($request['_token']);
//        $request['merchant_password'] = Hash::make($request['merchant_password']);
//        try {
//            Merchant::create($request->all());
//            return redirect()->intended('/admin/dashboard')->with('Success',"Successfully Registered");
//        }
//        catch (\Exception $exception) {
//            return back()->with('Failed', $exception->getMessage());
//        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Merchant  $merchant
     * @return \Illuminate\Http\Response
     */
    public function show(Merchant $merchant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Merchant  $merchant
     * @return \Illuminate\Http\Response
     */
    public function edit(Merchant $merchant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Merchant  $merchant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Merchant $merchant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Merchant  $merchant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Merchant $merchant)
    {
        //
    }
}
