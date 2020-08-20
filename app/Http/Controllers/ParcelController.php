<?php

namespace App\Http\Controllers;

use App\Area;
use App\Customer;
use App\DeliveryMan;
use App\Merchant;
use App\Notification;
use App\Parcel;
use App\ParcelStatus;
use App\ParcelStatusHistory;
use App\ParcelType;
use App\Shop;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ParcelController extends Controller
{

    public function index($day)
    {
        $cod_charge = Merchant::where('merchant_id', Auth::guard('merchant')->id())->first();
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

        $is_same_day = true;
        if ($day == "next_day") {
            $is_same_day = false;
        }
        //return $cod_charge;
        return view('merchant.parcel.index')
            ->with('cod_charge', $cod_charge)
            ->with('invoice', $invoice)
            ->with('is_same_day', $is_same_day)
            ->with('areas', $result = Area::get())
            ->with('shops', Shop::where('merchant_id', Auth::guard('merchant')->id())->get())
            ->with('parcel_types', ParcelType::orderBy('created_at', 'DESC')->get());
    }

    public function store(Request $request)

    {
        //return $request->all();
        $area_charge = Area::where('area_id', $request['area_id'])->first();
        if (is_null($area_charge)) {
            $area_charge_value = 0;
        } else {
            $area_charge_value = $area_charge->value;
        }
        //return $request->all();
        if ($request->shop_id == null)
            /*   return back()->with('failed', "Please Select Your Shop");*/
            Redirect::to('/logout');

        $request->validate([
            /*  'delivery_charge' => 'required|numeric',*/
            'area_id' => 'required',
            'parcel_type_id' => 'required|numeric|min:1',
            'customer_phone' => 'required|digits_between:11,11',

        ]);


        unset($request['_token']);


        if ($request['is_same_day']) {
            $delivery_date = Carbon::now()->format('d-m-y');
        } else {
            $delivery_date = Carbon::now()->addDays(1)->format('d-m-y');
            $request['is_same_day'] = false;
        }


        // return $request->all();
        $parcel_array = [
            'parcel_title' => $request['parcel_title'],
            'merchant_id' => Auth::guard('merchant')->id(),
            'parcel_invoice' => $request['parcel_invoice'],
            'parcel_type_id' => $request['parcel_type_id'],
            'shop_id' => $request['shop_id'],
            'area_id' => $request['area_id'],
            'delivery_charge' => $request['delivery_charge'],
            'payable_amount' => $request['payable_amount'],
            'cod' => $request['cod'],
            'area_charge' => $area_charge_value,
            'receivable_amount' => $request['payable_amount'] + ($request['cod'] + $area_charge_value + $request['delivery_charge']),
            'total_amount' => $request['payable_amount'] + ($request['cod'] + $area_charge_value + $request['delivery_charge']),
            'is_same_day' => $request['is_same_day'],
            'delivery_date' => $delivery_date,
            'parcel_notes' => $request['parcel_notes'],
            'is_online_payment' => $request['is_online_payment'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

        ];


        //return $parcel_array;

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

            return back()->with('failed', $exception->getMessage());

            return $exception->getMessage();
        }


        try {
            ParcelStatus::create($parcel_status_array);
            return back()->with('success', "Successfully Saved");
        } catch (\Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }


    public function show(Parcel $parcel)
    {

        $parcels = Parcel::join('parcel_statuses', 'parcel_statuses.parcel_id', '=', 'parcels.parcel_id')
            ->join('customers', 'parcel_statuses.customer_id', '=', 'customers.customer_id')
            ->where('merchant_id', Auth::guard('merchant')->id())
            ->orderBy('parcels.created_at', "DESC")
            ->paginate(15);
        return view('merchant.parcel.show')
            ->with('results', $parcels);
    }

    public function sameDaySearch(Parcel $parcel)
    {

        $parcels = Parcel::join('parcel_statuses', 'parcel_statuses.parcel_id', '=', 'parcels.parcel_id')
            ->join('customers', 'parcel_statuses.customer_id', '=', 'customers.customer_id')
            ->where('merchant_id', Auth::guard('merchant')->id())
            ->where('is_same_day', true)
            ->orderBy('parcels.created_at', "DESC")
            ->paginate(15);
        return view('merchant.parcel.show')
            ->with('results', $parcels);
    }

    public function nextDaySearch(Parcel $parcel)
    {

        $parcels = Parcel::join('parcel_statuses', 'parcel_statuses.parcel_id', '=', 'parcels.parcel_id')
            ->join('customers', 'parcel_statuses.customer_id', '=', 'customers.customer_id')
            ->where('merchant_id', Auth::guard('merchant')->id())
            ->where('is_same_day', false)
            ->orderBy('parcels.created_at', "DESC")
            ->paginate(15);
        return view('merchant.parcel.show')
            ->with('results', $parcels);
    }

    public function invoiceSearch(Parcel $parcel, Request $request)
    {
        $invoice = $request['invoice'];

        $parcels = Parcel::where('parcel_invoice', 'LIKE', '%' . $invoice . '%')
            ->join('parcel_statuses', 'parcel_statuses.parcel_id', '=', 'parcels.parcel_id')
            ->join('customers', 'parcel_statuses.customer_id', '=', 'customers.customer_id')
            ->where('merchant_id', Auth::guard('merchant')->id())
            ->orderBy('parcels.created_at', 'desc')
            ->paginate(15);


        return view('merchant.parcel.show')
            ->with('results', $parcels)
            ->with('invoice', $invoice);

    }


    public function statusSearch(Parcel $parcel, Request $request)
    {


        $status = $request['status'];
        $parcels = Parcel::join('parcel_statuses', 'parcel_statuses.parcel_id', '=', 'parcels.parcel_id')
            ->join('customers', 'parcel_statuses.customer_id', '=', 'customers.customer_id')
            ->leftJoin('delivery_men', 'delivery_men.delivery_man_id', '=', 'parcel_statuses.delivery_man_id')
            ->Join('areas', 'areas.area_id', '=', 'parcels.area_id')
            ->where('parcel_statuses.delivery_status', 'LIKE', '%' . $status . '%')
            ->orderBy('parcels.created_at', 'desc')
            ->paginate(15);
        return view('merchant.parcel.show')
            ->with('results', $parcels)
            ->with('status', $status);
    }


    public function adminParcelShow(Parcel $parcel)
    {

        $parcels = Parcel::join('parcel_statuses', 'parcel_statuses.parcel_id', '=', 'parcels.parcel_id')
            ->join('customers', 'parcel_statuses.customer_id', '=', 'customers.customer_id')
            ->leftJoin('delivery_men', 'delivery_men.delivery_man_id', '=', 'parcel_statuses.delivery_man_id')
            ->Join('areas', 'areas.area_id', '=', 'parcels.area_id')
            ->orderBy('parcels.created_at', "DESC")
            ->paginate(15);
        $delivery_mans = DeliveryMan::where('active_status', true)->get();
        $areas = Area::get();
        return view('admin.consignment.show')
            ->with('delivery_mans', $delivery_mans)
            ->with('areas', $areas)
            ->with('results', $parcels);
    }


    public function parcelStatusHubReceive($id)
    {
        //TODO::Delete check
        $status = "hub_received";
        try {

            ParcelStatus::where('parcel_id', $id)->update([
                'delivery_status' => "hub_received",
                'hub_receiver' => Auth::user()->id,
            ]);

            //Insert into History Table
            $array = [
                'parcel_id' => $id,
                'changed_by' => Auth::user()->id,
                'parcel_status' => $status,
                'user_type' => "admin",
            ];
            ParcelStatusHistory::create($array);

            return back()->with('success', "Successfully Status Changed");

        } catch (\Exception $exception) {

            return back()->with('failed', $exception->getMessage());
        }
    }


    public function parcelStatusReturnToAdmin($id)
    {

        $status = "returned_to_admin";
        try {

            ParcelStatus::where('parcel_id', $id)->update([
                'delivery_status' => $status,
                'hub_receiver' => Auth::user()->id,
            ]);

            //Insert into History Table
            $array = [
                'parcel_id' => $id,
                'changed_by' => Auth::user()->id,
                'parcel_status' => $status,
                'user_type' => "admin",
            ];
            ParcelStatusHistory::create($array);

            return back()->with('success', "Successfully Status Changed");

        } catch (\Exception $exception) {

            return back()->with('failed', $exception->getMessage());
        }
    }

    public function parcelStatusResolveMerchantReturn($id)
    {

        $status = "resolve_merchant_return";
        try {

            ParcelStatus::where('parcel_id', $id)->update([
                'delivery_status' => $status,
                'hub_receiver' => Auth::user()->id,
            ]);

            //Insert into History Table
            $array = [
                'parcel_id' => $id,
                'changed_by' => Auth::user()->id,
                'parcel_status' => $status,
                'user_type' => "admin",
            ];
            ParcelStatusHistory::create($array);

            return back()->with('success', "Successfully Status Changed");

        } catch (\Exception $exception) {

            return back()->with('failed', $exception->getMessage());
        }
    }

    public function details($id)
    {

        $parcels = Parcel::leftJoin('parcel_statuses', 'parcel_statuses.parcel_id', '=', 'parcels.parcel_id')
            ->leftJoin('customers', 'parcel_statuses.customer_id', '=', 'customers.customer_id')
            ->leftJoin('delivery_men', 'parcel_statuses.delivery_man_id', '=', 'delivery_men.delivery_man_id')
            ->leftJoin('areas', 'areas.area_id', '=', 'parcels.area_id')
            ->where('parcels.parcel_id', $id)
            ->first();
        $shop = Shop::where('merchant_id', Auth::guard('merchant')->id())->first();

        $history = ParcelStatusHistory::where('parcel_id', $id)->get();
        return view('merchant.parcel.details')
            ->with('result', $parcels)
            ->with('shop', $shop)
            ->with('histories', $history);
    }

    public function adminAssignDeliveryMan(Request $request)
    {

        $invoice = Parcel::where('parcel_id', $request['parcel_id'])->first();

        $status = "delivery_man_assigned";

        try {

            ParcelStatus::where('parcel_id', $request['parcel_id'])->update(['delivery_man_id' => $request['delivery_man_id']]);
            ParcelStatus::where('parcel_id', $request['parcel_id'])->update(['delivery_status' => $status]);
            $array = [
                'parcel_status' => $status,
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


    public function adminAssignPickUpMan(Request $request)
    {
        $invoice = Parcel::where('parcel_id', $request['parcel_id'])->first();


        $request->validate([
            /*  'delivery_charge' => 'required|numeric',*/
            /*  'total_amount' => 'required|numeric',*/
            'delivery_man_id' => 'required|numeric|min:1',

        ]);


        try {

            ParcelStatus::where('parcel_id', $request['parcel_id'])->update([
                'order_pickup_man_id' => $request['delivery_man_id'],
                'delivery_status' => 'pickup_man_assigned',

            ]);
            $array = [
                'parcel_status' => 'pickup_man_assigned',
                'changed_by' => Auth::guard()->user()->id,
                'parcel_id' => $request['parcel_id'],
                'user_type' => 'admin'
            ];


            ParcelStatusHistory::create($array);
            $notification = [
                'message' => 'Assigned for  no ' . $invoice->parcel_invoice,
                'for_user_id' => $request['delivery_man_id'],
                'changed_by' => Auth::guard()->user()->id,
                'is_for_collect' => true

            ];
            Notification::create($notification);
            return back()->with('success', "Successfully Assigned Delivery Man");
        } catch (\Exception $exception) {

            return $exception->getMessage();

        }
    }

    public function AdminReturentNotes($id)
    {
        $res = Parcel::where('parcel_id', $id)->first();
        return view('admin.consignment.return_note')->with('res', $res);
    }

    public function productReceiveByAdmin(Request $request)
    {


        try {


            $array = [
                'parcel_status' => 'returned_to_admin',
                'changed_by' => Auth::guard()->user()->id,
                'parcel_id' => $request['parcel_id'],
                'user_type' => 'admin',
            ];


            Parcel::where('parcel_id', $request['parcel_id'])->update([
                'admin_notes' => $request['notes']
            ]);


            //Update Parcel Status
            ParcelStatus::where('parcel_id', $request['parcel_id'])->update(['delivery_status' => 'returned_to_admin', 'is_complete' => true]);

            //Insert Into parcel Histiry
            ParcelStatusHistory::create($array);
            /*  $notification = [
                  'message' => 'Assigned for  no ' . $invoice->parcel_invoice,
                  'for_user_id' => $request['delivery_man_id'],
                  'changed_by' => Auth::guard()->user()->id,

              ];
              Notification::create($notification);*/
            /*return back()->with('success', "Successfully Returned to Admin");*/

            return Redirect::to("/admin/parcel/show")->with('success', "Successfully updated");
        } catch (\Exception $exception) {

            return back()->with('failed', $exception->getMessage());

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
        $cod_charge = Merchant::where('merchant_id', Auth::guard('merchant')->id())->first();
        if (is_null($cod_charge)) {
            $cod_charge = 0;
        } else {
            $cod_charge = $cod_charge->cod_charge;
        }
        $result = Parcel::join('parcel_statuses', 'parcel_statuses.parcel_id', '=', 'parcels.parcel_id')
            ->join('customers', 'parcel_statuses.customer_id', '=', 'customers.customer_id')
            ->where('parcels.parcel_id', $parcel_id)
            ->first();
        return view('merchant.parcel.edit')
            ->with('cod_charge', $cod_charge)
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
        unset($request['_token']);
        try {
            $parcel_array = [
                'parcel_notes' => $request['parcel_notes'],

            ];
            Parcel::where('parcel_id', $request['parcel_id'])->update($parcel_array);


            $customer_array = [
                'customer_name' => $request['customer_name'],
                'customer_phone' => $request['customer_phone'],
                'customer_address' => $request['customer_address'],
            ];

            Customer::where('customer_id', $request['customer_id'])->update($customer_array);
            return back()->with('success', "Successfully update");

        } catch (\Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Parcel $parcel
     * @return \Illuminate\Http\Response
     */
    public function printParcel(Request $request)
    {

        return view('merchant.parcel.all_details');

    }

    public function allParcel(Request $request)
    {
        if (!$request['parcel_id']) {
            return back()->with('failed', "Please select atleast 1 item");
        }

        if ($request['change'] == 1) {
            $parcel_data = [];
            $shop = Shop::where('merchant_id', Auth::guard('merchant')->id())->first();
            foreach ($request['parcel_id'] as $parcel_id) {

                $parcel_data[] = Parcel::join('parcel_statuses', 'parcel_statuses.parcel_id', '=', 'parcels.parcel_id')
                    ->leftjoin('customers', 'parcel_statuses.customer_id', '=', 'customers.customer_id')
                    ->where('parcels.parcel_id', $parcel_id)->first();
            }


            // return $parcel_data;
            return view('merchant.parcel.print_qr')
                ->with('shop', $shop)
                ->with('parcel_data', $parcel_data);
        } else {
            foreach ($request['parcel_id'] as $parcel_id) {

                $this->destroy($parcel_id);
            }
            return back()->with('success', "Successfully Deleted");
        }


    }

    public function destroy($id)
    {


        //TODO::Delete check
        $parcel = Parcel::join('parcel_statuses', 'parcel_statuses.parcel_id', '=', 'parcels.parcel_id')
            ->where('parcel_statuses.delivery_status', "pending")
            ->where('parcels.parcel_id', $id)
            ->first();
        if (is_null($parcel)) {
            return back()->with('failed', "This parcel can't deleted");
        } else {
            Parcel::where('parcel_id', $id)->delete();
            ParcelStatus::where('parcel_id', $id)->delete();
            return back()->with('success', "Successfully Deleted");

        }


    }

    public function adminParceldetails($id)
    {
        $parcels = Parcel::join('parcel_statuses', 'parcel_statuses.parcel_id', '=', 'parcels.parcel_id')
            ->join('customers', 'parcel_statuses.customer_id', '=', 'customers.customer_id')
            ->join('areas', 'areas.area_id', '=', 'parcels.area_id')
            ->where('parcels.parcel_id', $id)
            ->first();

        $history = ParcelStatusHistory::where('parcel_id', $id)->get();
        return view('admin.consignment.details')
            ->with('result', $parcels)
            ->with('histories', $history);
    }
}
