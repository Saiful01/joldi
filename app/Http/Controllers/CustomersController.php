<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomersController extends Controller
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
        return view('admin.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator= Validator::make($request->all(),[
            "customer_name"=>'required',
            "customer_phone"=>'required',
            "customer_address"=>'required'
        ]);
        if ($validator->fails()){
            return back()->with("Failed","Check Requiered Field");
        }
        unset($request['_token']);

        try {
            Customer::create($request->all());
            return back()->with("Success","Successfully Saved");
        }
        catch (\Exception $exception){
            return back()->with("Failed", $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function show(Customers $customers)
    {
        return view('admin.customer.view')->with('result', Customer::get());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function edit( $customer_id)
    {
        $result= Customer::where('customer_id', $customer_id)->first();
        return view('admin.customer.edit')->with('result', $result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customers $customers)
    {
        unset($request['_token']);
        try {
            Customer::create($request->all());
            return back()->with("Success","Successfully Updated");
        }
        catch (\Exception $exception){
            return back()->with('Failed', $exception->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        try {
            Customer::where('customer_id', $id)->delete();
            return back()->with('Success', "Successfully Deleted");
        }
        catch (\Exception $exception){
            return back()->with('failed', $exception->getMessage());
        }
    }
}
