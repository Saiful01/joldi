<?php

namespace App\Http\Controllers;

use App\DeliveryMan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DeliveryManController extends Controller
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
        return view('admin.deliveryman.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        unset($request['_token']);
        $request ['password']= Hash::make($request['password']);
        try {
           DeliveryMan::create($request->all());
            return back()->with('success',"Successfully Saved");
        }
        catch (\Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DeliveryMan  $deliveryMan
     * @return \Illuminate\Http\Response
     */
    public function show(DeliveryMan $deliveryMan)
    {
        $result= DeliveryMan::get();
        return view('admin.deliveryman.view')->with('result' , $result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DeliveryMan  $deliveryMan
     * @return \Illuminate\Http\Response
     */
    public function edit( $delivery_man_id)
    {
       $result= DeliveryMan::where('delivery_man_id', $delivery_man_id)->first();
        return view('admin.deliveryman.edit')->with('result', $result);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DeliveryMan  $deliveryMan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DeliveryMan $deliveryMan)
    {
        unset($request['_token']);
        $request ['delivery_man_password']= Hash::make($request['delivery_man_password']);
        try {
            DeliveryMan::where('delivery_man_id', $request['delivery_man_id'])->update($request->all());
            return back()->with('success',"Successfully Updated");
        }
        catch (\Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DeliveryMan  $deliveryMan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DeliveryMan::where('delivery_man_id', $id)->delete();
            return back()->with('success', 'Successfully deleted');
        }
        catch (\Exception $exception){
            return back()->with('failed', $exception->getMessage());
        }
    }
}
