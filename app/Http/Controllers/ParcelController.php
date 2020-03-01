<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Merchant;
use App\Parcel;
use App\ParcelStatus;
use App\ParcelStatusHistory;
use App\ParcelType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParcelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $cod_charge = Merchant::where('merchant_id', Auth::id())->first();
        if (is_null($cod_charge)) {
            $cod_charge = 0;
        } else {
            $cod_charge = $cod_charge->cod_charge;
        }
        $invoice_data = Parcel::orderBy('created_at', 'DESC')->first();
        if(is_null($invoice_data)){
            $invoice=date('dhis');
        }else{
            $invoice = $invoice_data->parcel_id . "" . date('dhis');
        }

        return view('admin.parcel.index')
            ->with('cod_charge', $cod_charge)
            ->with('invoice', $invoice)
            ->with('results', ParcelType::orderBy('created_at', 'DESC')->get());
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
//        $validator= Validator::make($request->all(),[
//            'delivery_charge'=>'required|digits:1',
//            'total_amount'=>'required|digits:1',
//
//        ]);
//        if ($validator->fails()){
//            return back()->with('failed',"Please Delivery Charge or Totall Amount is number");
//        }
        unset($request['_token']);
        unset($request['is_same_day']);

        //return  $request->all();
        if ($request['is_same_day'] == "on") {
            $request['is_same_day'] = true;
        } else {
            $request['is_same_day'] = false;
        }

        $request['delivery_date'] = Carbon::parse($request['delivery_date'])->format('Y-m-d');
        $parcel_array = [
            'parcel_title' => $request['parcel_title'],
            'parcel_invoice' => $request['parcel_invoice'],
            'parcel_type_id' => $request['parcel_type_id'],
            'delivery_charge' => $request['delivery_charge'],
            'payable_amount' => $request['payable_amount'],
            'cod' => $request['cod'],
            'total_amount' => $request['payable_amount'] - ($request['cod'] + $request['delivery_charge']),
            'is_same_day' => $request['is_same_day'],
            'delivery_date' => $request['delivery_date'],
            'parcel_notes' => $request['parcel_notes'],
            'created_at' =>Carbon::now(),
            'updated_at' =>Carbon::now(),

        ];

        $parcel_id = Parcel::insertGetId($parcel_array);
        $customer_array = [
            'customer_name' => $request['customer_name'],
            'customer_phone' => $request['customer_phone'],
            'customer_email' => $request['customer_email'],
            'customer_address' => $request['customer_address'],
            'longitude' => $request['longitude'],
            'latitude' => $request['latitude']
        ];

        $customer_is_exist = Customer::where('customer_phone', $request['customer_phone'])->first();
        if (is_null($customer_is_exist)) {
            $customer_id = Customer::insertGetId($customer_array);
        } else {
            $customer_id = $customer_is_exist->customer_id;
        }

        $parcel_status_array = [
            'customer_id' => $customer_id,
            'parcel_id' => $parcel_id,
        ];

        $parcel_history = [
            'parcel_id' => $parcel_id,
            'changed_by' => 1,//TODO::Change Later
        ];


        try {
            ParcelStatusHistory::create($parcel_history);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }


        try {
            ParcelStatus::create($parcel_status_array);
            return back()->with('success', "Successfully Saved");
        } catch (\Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Parcel $parcel
     * @return \Illuminate\Http\Response
     */
    public function show(Parcel $parcel)
    {

        $parcels = Parcel::join('parcel_statuses', 'parcel_statuses.parcel_id', '=', 'parcels.parcel_id')
            ->join('customers', 'parcel_statuses.customer_id', '=', 'customers.customer_id')
            ->get();
        return view('merchant.parcel.show')
            ->with('results', $parcels);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Parcel $parcel
     * @return \Illuminate\Http\Response
     */
    public function edit(Parcel $parcel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Parcel $parcel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Parcel $parcel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Parcel $parcel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Parcel::where('parcel_id', $id)->delete();
            return back()->with('success', "Successfully Deleted");

        } catch (\Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }

    }
}
