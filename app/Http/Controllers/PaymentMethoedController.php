<?php

namespace App\Http\Controllers;

use App\PaymentMethoed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentMethoedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('merchant.paymentmethoed.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        unset($request['token']);
        $id = Auth::guard('merchant')->id();
        $array = [
            'payment_methoed_name' => $request['payment_methoed_name'],
            'account_number' => $request['account_number'],
            'branch_address' => $request['branch_address'],
            'payee_name' => $request['payee_name'],
            'merchant_id' => $id
        ];
        try {
            PaymentMethoed::create($array);
            return back()->with('success', "Successfully saved");
        }
        catch (\Exception $exception){
            return back()->with('failed', $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PaymentMethoed  $paymentMethoed
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentMethoed $paymentMethoed)
    {
        $id = Auth::guard('merchant')->id();
        $result= PaymentMethoed::where('merchant_id', $id)->get();
        return view('merchant.paymentmethoed.view')->with('result', $result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PaymentMethoed  $paymentMethoed
     * @return \Illuminate\Http\Response
     */
    public function edit( $paymentmethoed_id)
    {
       return $result=PaymentMethoed::where('paymentmethoed_id', $paymentmethoed_id)->first();
        return view('merchant.paymentmethoed.edit')->with('result', $result);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PaymentMethoed  $paymentMethoed
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentMethoed $paymentMethoed)
    {
        unset($request['token']);
        try {
            PaymentMethoed::where('paymentmethoed_id', $request['paymentmethoed_id'])->update($request->all());
            return back()->with('success', "successfully saved");
        }
        catch (\Exception $exception){
            return back()->with('failed', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PaymentMethoed  $paymentMethoed
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentMethoed $paymentMethoed)
    {

    }
}
