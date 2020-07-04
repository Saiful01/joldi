<?php

namespace App\Http\Controllers\Api;

use App\CurrentLocation;
use App\DeliveryMan;
use App\Http\Controllers\Controller;
use App\Parcel;
use App\ParcelStatus;
use App\ParcelStatusHistory;
use Illuminate\Http\Request;

class ParcelApiController extends Controller
{


    public function getCololectableParcel(Request $request)
    {


        $status_code = 200;
        $message = "Logged in";
        $access_token = "ABC";
        $parcels = null;


        $delivery_man_id = $request['delivery_man_id'];

        try {
            $query = Parcel::join('parcel_statuses', 'parcel_statuses.parcel_id', '=', 'parcels.parcel_id')
                /*   ->join('delivery_men', 'parcel_statuses.delivery_man_id', '=', 'delivery_men.delivery_man_id')*/
                ->leftjoin('customers', 'parcel_statuses.customer_id', '=', 'customers.customer_id')
                ->where('parcel_statuses.order_pickup_man_id', $delivery_man_id);
            if ($request['status'] != "all") {
                $query->where('parcel_statuses.delivery_status', $request['status']);
            }

            $parcels = $query->get();


        } catch (\Exception $exception) {

            $status_code = $exception->getCode();
            $message = $exception->getMessage();
        }

        return [
            'status_code' => $status_code,
            'message' => $message,
            'access_token' => $access_token,
            'data' => $parcels,
        ];


    }

    public function getParcel(Request $request)
    {


        $status_code = 200;
        $message = "Logged in";
        $access_token = "ABC";
        $parcels = null;


        $delivery_man_id = $request['delivery_man_id'];

        try {
            $query = Parcel::join('parcel_statuses', 'parcel_statuses.parcel_id', '=', 'parcels.parcel_id')
                /*   ->join('delivery_men', 'parcel_statuses.delivery_man_id', '=', 'delivery_men.delivery_man_id')*/
                ->join('customers', 'parcel_statuses.customer_id', '=', 'customers.customer_id')
                ->where('parcel_statuses.delivery_man_id', $delivery_man_id);
            if ($request['status'] != "all") {
                $query->where('parcel_statuses.delivery_status', $request['status']);
            }

            $parcels = $query->get();


        } catch (\Exception $exception) {

            $status_code = $exception->getCode();
            $message = $exception->getMessage();
        }

        return [
            'status_code' => $status_code,
            'message' => $message,
            'access_token' => $access_token,
            'data' => $parcels,
        ];


    }

    public function parcelTracking(Request $request)
    {


        $status_code = 200;
        $message = "Get Parcels";
        $access_token = "ABC";
        $parcels = null;

        $customer_phone = $request['customer_phone'];
        // return $customer = Customer::where('customer_phone', $customer_phone)->get();

        //return $customer->customer_id;


        try {
            $parcels = Parcel::join('parcel_statuses', 'parcel_statuses.parcel_id', '=', 'parcels.parcel_id')
                /*->join('delivery_men', 'parcel_statuses.customer_phone', '=', 'delivery_men.delivery_man_id')*/
                ->leftJoin('customers', 'parcel_statuses.customer_id', '=', 'customers.customer_id')
                ->where('customers.customer_phone', $customer_phone)
                ->orderBy('parcels.created_at', "DESC")
                ->get();

            foreach ($parcels as $parcel) {

                if ($parcel->delivery_man_id != null) {
                    $delivery = DeliveryMan::where('delivery_man_id', $parcel->delivery_man_id)->first();

                    $parcel->delivery_man_name = $delivery->delivery_man_name;
                    $parcel->delivery_man_phone = $delivery->delivery_man_phone;
                } else {
                    $parcel->delivery_man_name = "Not Assigned";
                    $parcel->delivery_man_phone = "Not Assigned";
                }


            }


        } catch (\Exception $exception) {

            $status_code = $exception->getCode();
            $message = $exception->getMessage();
        }

        return [
            'status_code' => $status_code,
            'message' => $message,
            'access_token' => $access_token,
            'data' => $parcels,
        ];


    }

    public function getParcelDetails(Request $request)
    {


        $status_code = 200;
        $message = "Logged in";
        $access_token = "ABC";
        $parcels_details = null;
        $parcel_statuses = null;


        $parcel_id = $request['parcel_id'];

        try {
            $parcels_details = Parcel::join('parcel_statuses', 'parcel_statuses.parcel_id', '=', 'parcels.parcel_id')
                ->leftJoin('delivery_men', 'parcel_statuses.delivery_man_id', '=', 'delivery_men.delivery_man_id')
                ->join('customers', 'customers.customer_id', '=', 'parcel_statuses.customer_id')
                ->where('parcels.parcel_id', $parcel_id)
                ->first();


            $parcel_statuses = ParcelStatusHistory::join('parcels', 'parcels.parcel_id', '=', 'parcel_status_histories.parcel_id')
                ->where('parcel_status_histories.parcel_id', $parcel_id)->get();
        } catch (\Exception $exception) {

            $status_code = $exception->getCode();
            $message = $exception->getMessage();
        }

        return [
            'status_code' => $status_code,
            'message' => $message,
            'access_token' => $access_token,
            'data' => $parcels_details,
            'statuses' => $parcel_statuses,
        ];


    }

    public function parcelUpdate(Request $request)
    {

        $status_code = 200;
        $message = "Parcel Updated";
        $access_token = "ABC";
        $parcels_details = null;

        $parcel_id = $request['parcel_id'];
        $status = $request['status'];

        $changed_by = $request['changed_by'];
        $notes = $request['notes'];

        try {
            if ($status == "delivered") {

                $parcel_array = [
                    'delivery_status' => $status,
                    'is_complete' => true,
                ];
            } else {

                $parcel_array = [
                    'delivery_status' => $status,
                ];
            }

            ParcelStatus::where('parcel_id', $parcel_id)->update($parcel_array);

            //Insert into History Table

            $array = [
                'parcel_id' => $parcel_id,
                'changed_by' => $changed_by,
                'parcel_status' => $status,
                'notes' => $notes,
                'user_type' => "deliveryman",

            ];
            ParcelStatusHistory::create($array);

        } catch (\Exception $exception) {

            $status_code = $exception->getCode();
            $message = $exception->getMessage();
        }

        return [
            'status_code' => $status_code,
            'message' => $message,
            'access_token' => $access_token,
            'data' => $parcels_details,
        ];
    }


    public function collectParcel(Request $request)
    {

        $status_code = 200;
        $message = "Parcel Updated";
        $access_token = "ABC";
        $parcels_details = null;
        $access_token = 0;


        $parcel_invoice = $request['invoice_number'];
        $status = $request['status'];

        $changed_by = $request['changed_by'];
        $notes = $request['notes'];

        $is_exist = Parcel::where('parcel_invoice', $parcel_invoice)//TODO::Need Modificatuion
        ->first();
        if (is_null($is_exist)) {
            return [
                'status_code' => 400,
                'message' => "Not Found",
                'access_token' => $access_token,
                'getTotalAmount' => 0,
                'data' => $parcels_details,
            ];
        }

        try {

            $parcel_array = [
                'delivery_status' => $status,
                'is_paid_to_merchant' => "received",
            ];


            ParcelStatus::where('parcel_id', $is_exist->parcel_id)->update($parcel_array);

            //Insert into History Table

            $array = [
                'parcel_id' => $is_exist->parcel_id,
                'changed_by' => $changed_by,
                'parcel_status' => $status,
                'notes' => $notes,
                'user_type' => "deliveryman",
            ];
            ParcelStatusHistory::create($array);

        } catch (\Exception $exception) {

            $status_code = $exception->getCode();
            $message = $exception->getMessage();
        }

        return [
            'status_code' => $status_code,
            'message' => $message,
            'access_token' => $access_token,
            'getTotalAmount' => $is_exist->payable_amount,
            'data' => $parcels_details,
        ];
    }






    public function locationStore(Request $request)
    {

        $status_code = 200;
        $message = "Location Updated";
        $access_token = "ABC";
        $parcels_details = null;
        $access_token = 0;


        try {

            $array = [
                'delivery_man_id' => $request['delivery_man_id'],
                'lat' => $request['lat'],
                'lon' => $request['lon'],
                'address' => $request['address'],

            ];
            CurrentLocation::create($array);

        } catch (\Exception $exception) {

            $status_code = $exception->getCode();
            $message = $exception->getMessage();
        }

        return [
            'status_code' => $status_code,
            'message' => $message,
            'access_token' => $access_token,
            'data' => $parcels_details
        ];
    }


    public function locationGet(Request $request)
    {

        $status_code = 200;
        $message = "Location Get";
        $access_token = "ABC";
        $data = null;
        $access_token = 0;


        $data = CurrentLocation::where('delivery_man_id', $request['delivery_man_id'])->orderBy('created_at')->first();


        return [
            'status_code' => $status_code,
            'message' => $message,
            'access_token' => $access_token,
            'data' => $data,
        ];
    }

}
