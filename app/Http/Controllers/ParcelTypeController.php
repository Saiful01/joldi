<?php

namespace App\Http\Controllers;

use App\ParcelType;
use Illuminate\Http\Request;

class ParcelTypeController extends Controller
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
        return view('admin.parceltypes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            ParcelType::create($request->all());
            return back()->with('success', "Successfully Saved");
        } catch (\Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\ParcelType $parcelType
     * @return \Illuminate\Http\Response
     */
    public function show(ParcelType $parcelType)
    {
        $result = ParcelType::get();
        return view('admin.parceltypes.view')->with('result', $result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\ParcelType $parcelType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result = ParcelType::where('parcel_type_id', $id)->first();
        return view('admin.parceltypes.edit')->with('result', $result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\ParcelType $parcelType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ParcelType $parcelType)
    {

        unset($request['_token']);
        try {
            ParcelType::where('parcel_type_id', $request['parcel_type_id'])->update($request->all());
            return back()->with('success', "Successfully Updated");
        } catch (\Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\ParcelType $parcelType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            ParcelType::where('parcel_type_id', $id)->delete();
            return back()->with('success', "Successfully Deleted");

        } catch (\Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }

    }
}
