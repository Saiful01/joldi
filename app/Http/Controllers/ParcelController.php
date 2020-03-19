<?php

namespace App\Http\Controllers;

use App\Customer;
use App\DeliveryMan;
use App\Merchant;
use App\Notification;
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
        if (is_null($invoice_data)) {
            $invoice = date('dhis');
        } else {
            $invoice = $invoice_data->parcel_id . "" . date('dhis');
        }

        return view('merchant.parcel.index')
            ->with('cod_charge', $cod_charge)
            ->with('invoice', $invoice)
            ->with('parcel_types', ParcelType::orderBy('created_at', 'DESC')->get());
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


        $is_same_day = false;
        $request->validate([
            'delivery_charge' => 'required|numeric',
            'total_amount' => 'required|numeric',
            'parcel_type_id' => 'required|numeric|min:1',

        ]);

        unset($request['_token']);

        //return  $request->all();
        if ($request['is_same_day'] == "on") {
            $is_same_day = true;
        }


        $request['delivery_date'] = Carbon::parse($request['delivery_date'])->format('Y-m-d');
        $parcel_array = [
            'parcel_title' => $request['parcel_title'],
            'merchant_id' => Auth::guard('merchant')->id(),
            'parcel_invoice' => $request['parcel_invoice'],
            'parcel_type_id' => $request['parcel_type_id'],
            'delivery_charge' => $request['delivery_charge'],
            'payable_amount' => $request['payable_amount'],
            'cod' => $request['cod'],
            'total_amount' => $request['payable_amount'] - ($request['cod'] + $request['delivery_charge']),
            'is_same_day' => $is_same_day,
            'delivery_date' => $request['delivery_date'],
            'parcel_notes' => $request['parcel_notes'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

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
            ->where('merchant_id', Auth::guard('merchant')->id())
            ->get();
        return view('merchant.parcel.show')
            ->with('results', $parcels);
    }


    public function adminParcelShow(Parcel $parcel)
    {

        $parcels = Parcel::join('parcel_statuses', 'parcel_statuses.parcel_id', '=', 'parcels.parcel_id')
            ->join('customers', 'parcel_statuses.customer_id', '=', 'customers.customer_id')
            ->leftJoin('delivery_men', 'delivery_men.delivery_man_id', '=', 'parcel_statuses.delivery_man_id')
            ->get();
        $delivery_mans = DeliveryMan::where('active_status', true)->get();
        return view('admin.consignment.show')
            ->with('delivery_mans', $delivery_mans)
            ->with('results', $parcels);
    }

    public function details($id)
    {

        $parcels = Parcel::join('parcel_statuses', 'parcel_statuses.parcel_id', '=', 'parcels.parcel_id')
            ->join('customers', 'parcel_statuses.customer_id', '=', 'customers.customer_id')
            ->where('parcels.parcel_id', $id)
            ->first();

        $history = ParcelStatusHistory::where('parcel_id', $id)->get();
        return view('merchant.parcel.details')
            ->with('result', $parcels)
            ->with('histories', $history);
    }

    public function adminAssignDeliveryMan(Request $request)
    {

        $invoice = Parcel::where('parcel_id', $request['parcel_id'])->first();


        try {

            ParcelStatus::where('parcel_id', $request['parcel_id'])->update(['delivery_man_id' => $request['delivery_man_id']]);
            ParcelStatus::where('parcel_id', $request['parcel_id'])->update(['delivery_status' => 'on_the_way']);
            $array = [
                'parcel_status' => 'on_the_way',
                'changed_by' => Auth::guard()->user()->id,
                'parcel_id' => $request['parcel_id'],
                'user_type' => 'admin'
            ];

            ParcelStatusHistory::create($array);
            $notification = [
                'message' => 'Assigned for  no ' . $invoice->parcel_invoice,
                'for_user_id' => $request['delivery_man_id'],
                'changed_by' => Auth::guard()->user()->id,

            ];
            Notification::create($notification);
            return back()->with('success', "Successfully Assigned Delivery Man");
        } catch (\Exception $exception) {

            return $exception->getMessage();

        }


    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Parcel $parcel
     * @return \Illuminate\Http\Response
     */
    public function edit($parcel_id)
    {
        $result = Parcel::join('parcel_statuses', 'parcel_statuses.parcel_id', '=', 'parcels.parcel_id')
            ->join('customers', 'parcel_statuses.customer_id', '=', 'customers.customer_id')
            ->where('parcels.parcel_id', $parcel_id)
            ->first();
        return view('merchant.parcel.edit')
            ->with('result', $result);

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


        if ($request['parcel_type_id'] == "? undefined:undefined ?") {
            return back()->with('failed', "Plaese select Parcel Type");
        }
        unset($request['_token']);

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
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

        ];

        $parcel_id = Parcel::where('parcel_id', $request['parcel_id'])->update($parcel_array);
        $customer_array = [
            'customer_name' => $request['customer_name'],
            'customer_phone' => $request['customer_phone'],
            'customer_email' => $request['customer_email'],
            'customer_address' => $request['customer_address'],
            'longitude' => $request['longitude'],
            'latitude' => $request['latitude']
        ];

        Customer::where('customer_id', $request['customer_id'])->update($customer_array);
        return back()->with('success', "Successfully update");


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

    public function adminParceldetails($id)
    {
        $parcels = Parcel::join('parcel_statuses', 'parcel_statuses.parcel_id', '=', 'parcels.parcel_id')
            ->join('customers', 'parcel_statuses.customer_id', '=', 'customers.customer_id')
            ->where('parcels.parcel_id', $id)
            ->first();

        $history = ParcelStatusHistory::where('parcel_id', $id)->get();
        return view('admin.consignment.details')
            ->with('result', $parcels)
            ->with('histories', $history);
    }
}
