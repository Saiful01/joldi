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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        return $request;
        unset($request['_token']);
        $request ['password'] = Hash::make($request['password']);
        $request ['active_status'] = true;

        if ($request->hasFile('delivery_man_image')) {


            $image = $request->file('delivery_man_image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/deliveryman/profile');
            $image->move($destinationPath, $image_name);
            $array = [

                'delivery_man_name' => $request['delivery_man_name'],
                'delivery_man_phone' => $request['delivery_man_phone'],
                'delivery_man_image' => $image_name,
                'password' => $request['password'],
                'delivery_man_address' => $request['delivery_man_address'],
                'active_status' => $request['active_status'],
                'delivery_man_type' => $request['delivery_man_type'],
                'delivery_man_email' => $request['delivery_man_email']
            ];
        } else if ($request->hasFile('delivery_man_document')) {


            $image = $request->file('delivery_man_document');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/deliveryman/deliverymanNid');
            $image->move($destinationPath, $image_name);
            $array = [

                'delivery_man_name' => $request['delivery_man_name'],
                'delivery_man_phone' => $request['delivery_man_phone'],
                'delivery_man_document' => $image_name,
                'password' => $request['password'],
                'delivery_man_address' => $request['delivery_man_address'],
                'active_status' => $request['active_status'],
                'delivery_man_type' => $request['delivery_man_type'],
                'delivery_man_email' => $request['delivery_man_email']
            ];
        } else {
            $array = [

                'delivery_man_name' => $request['delivery_man_name'],
                'delivery_man_phone' => $request['delivery_man_phone'],
                'password' => $request['password'],
                'delivery_man_address' => $request['delivery_man_address'],
                'active_status' => $request['active_status'],
                'delivery_man_type' => $request['delivery_man_type'],
                'delivery_man_email' => $request['delivery_man_email']
            ];


        }
        try {
            DeliveryMan::create($array);
            return back()->with('success', "Successfully Saved");
        } catch (\Exception $exception) {

            return back()->with('failed', $exception->getMessage());
        }
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
            $request['nid'] = $image_name;

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
        $result = DeliveryMan::get();
        return view('admin.deliveryman.view')->with('result', $result);
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
        $request ['delivery_man_password'] = Hash::make($request['delivery_man_password']);
        try {
            DeliveryMan::where('delivery_man_id', $request['delivery_man_id'])->update($request->all());
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
