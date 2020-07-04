<?php

namespace App\Http\Controllers;

use App\DeliveryMan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DeliveryManController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.deliveryman.registration');
    }

    public function locationtrack()
    {
        $results = DeliveryMan::get();
        return view('admin.deliveryman.map')->with('results', $results);

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

    public function registrationStore(Request $request)
    {
        unset($request['_token']);
        $request ['password'] = Hash::make($request['password']);
        $request ['active_status'] = false;

        if ($request->hasFile('image')) {


            $image = $request->file('image');
            $image_name = "profile_" . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $image_name);
            $request['delivery_man_image'] = $image_name;

        }
        if ($request->hasFile('nid')) {


            $image = $request->file('nid');
            $image_name = "nid_" . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $image_name);
            $request['delivery_man_document'] = $image_name;

        }

        if ($request->hasFile('licen')) {


            $image = $request->file('licen');
            $image_name = "licen_" . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/');
            $image->move($destinationPath, $image_name);
            $request['license'] = $image_name;


        }

        if ($request->hasFile('tax')) {


            $image = $request->file('tax');
            $image_name = "tax_" . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $image_name);
            $request['tax_token'] = $image_name;


        }

        if ($request->hasFile('blue')) {


            $image = $request->file('blue');
            $image_name = "blue_" . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $image_name);
            $request['blue_book'] = $image_name;

        }

        if ($request->hasFile('insu')) {


            $image = $request->file('insu');
            $image_name = "insu_" . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $image_name);
            $request['insurence'] = $image_name;

        }

        $data = $request->except(['image', '_token', 'insu', 'blue', 'tax', 'licen', 'nid']);

        //return $request->all();

        try {
            DeliveryMan::create($data);
            return back()->with('success', "Registration Successfull");
        } catch (\Exception $exception) {

            return back()->with('failed', $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DeliveryMan $deliveryMan
     * @return \Illuminate\Http\Response
     */
    public function show(DeliveryMan $deliveryMan)
    {
        $result = DeliveryMan::orderBY('created_at', "DESC")->get();
        return view('admin.deliveryman.view')->with('result', $result);
    }

    public function details($id)
    {
        $result = DeliveryMan::where('delivery_man_id', $id)->first();
        return view('admin.deliveryman.details')->with('result', $result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DeliveryMan $deliveryMan
     * @return \Illuminate\Http\Response
     */
    public function edit($delivery_man_id)
    {
        $result = DeliveryMan::where('delivery_man_id', $delivery_man_id)->first();
        return view('admin.deliveryman.edit')->with('result', $result);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\DeliveryMan $deliveryMan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DeliveryMan $deliveryMan)
    {
        unset($request['_token']);
        if ($request->hasFile('image')) {


            $image = $request->file('image');
            $image_name = "profile_" . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $image_name);
            $request['delivery_man_image'] = $image_name;

        }
        if ($request->hasFile('nid')) {


            $image = $request->file('nid');
            $image_name = "nid_" . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $image_name);
            $request['delivery_man_document'] = $image_name;

        }

        if ($request->hasFile('licen')) {


            $image = $request->file('licen');
            $image_name = "licen_" . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/');
            $image->move($destinationPath, $image_name);
            $request['license'] = $image_name;


        }

        if ($request->hasFile('tax')) {


            $image = $request->file('tax');
            $image_name = "tax_" . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $image_name);
            $request['tax_token'] = $image_name;


        }

        if ($request->hasFile('blue')) {


            $image = $request->file('blue');
            $image_name = "blue_" . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $image_name);
            $request['blue_book'] = $image_name;

        }

        if ($request->hasFile('insu')) {


            $image = $request->file('insu');
            $image_name = "insu_" . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $image_name);
            $request['insurence'] = $image_name;

        }

        $data = $request->except(['image', '_token', 'insu', 'blue', 'tax', 'licen', 'nid']);

        //return $request->all();
        try {
            DeliveryMan::where('delivery_man_id', $request['delivery_man_id'])->update($data);
            return back()->with('success', "Successfully Updated");
        } catch (\Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DeliveryMan $deliveryMan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DeliveryMan::where('delivery_man_id', $id)->delete();
            return back()->with('success', 'Successfully deleted');
        } catch (\Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }
}
