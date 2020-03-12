<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Parcel;
use App\ParcelStatus;
use App\ParcelStatusHistory;
use Illuminate\Http\Request;

class ParcelApiController extends Controller
{

    public function getParcel(Request $request){


        $status_code=200;
        $message="Logged in";
        $access_token="ABC";
        $parcels=null;


        $delivery_man_id=$request['delivery_man_id'];

       try{
           $parcels = Parcel::join('parcel_statuses', 'parcel_statuses.parcel_id', '=', 'parcels.parcel_id')
               ->join('delivery_men', 'parcel_statuses.delivery_man_id', '=', 'delivery_men.delivery_man_id')
               ->where('parcel_statuses.delivery_man_id',$delivery_man_id)
               ->get();
       }catch (\Exception $exception){

           $status_code=$exception->getCode();
           $message=$exception->getMessage();
       }

        return [
            'status_code'=>$status_code,
            'message'=>$message,
            'access_token'=>$access_token,
            'data'=>$parcels,
        ];


    }

    public function getParcelDetails(Request $request){


        $status_code=200;
        $message="Logged in";
        $access_token="ABC";
        $parcels_details=null;
        $parcel_statuses=null;


        $parcel_id=$request['parcel_id'];

        try{
            $parcels_details = Parcel::join('parcel_statuses', 'parcel_statuses.parcel_id', '=', 'parcels.parcel_id')
                ->leftJoin('delivery_men', 'parcel_statuses.delivery_man_id', '=', 'delivery_men.delivery_man_id')
                ->join('customers', 'customers.customer_id', '=', 'parcel_statuses.customer_id')
                ->where('parcels.parcel_id', $parcel_id)
                ->first();


            $parcel_statuses=ParcelStatusHistory::where('parcel_id', $parcel_id)->get();
        }catch (\Exception $exception){

            $status_code=$exception->getCode();
            $message=$exception->getMessage();
        }

        return [
            'status_code'=>$status_code,
            'message'=>$message,
            'access_token'=>$access_token,
            'data'=>$parcels_details,
            'statuses'=>$parcel_statuses,
        ];


    }

    public function parcelUpdate(Request $request){

        $status_code=200;
        $message="Parcel Updated";
        $access_token="ABC";
        $parcels_details=null;


        $parcel_id=$request['parcel_id'];
        $status=$request['status'];

        $changed_by=$request['changed_by'];
        $notes=$request['notes'];

        try{
            if($status=="delivered"){

                $parcel_array=[
                    'delivery_status'=>$status,
                    'is_complete'=>true,
                ];
            }else{

                $parcel_array=[
                    'delivery_status'=>$status,
                ];
            }

            ParcelStatus::where('parcel_id',$parcel_id)->update($parcel_array);

            //Insert into History Table

            $array=[
                'parcel_id'=>$parcel_id,
                'changed_by'=>$changed_by,
                'parcel_status'=>$status,
                'notes'=>$notes,
                'user_type'=>"deliveryman",

            ];
            ParcelStatusHistory::create($array);

        }catch (\Exception $exception){

            $status_code=$exception->getCode();
            $message=$exception->getMessage();
        }

        return [
            'status_code'=>$status_code,
            'message'=>$message,
            'access_token'=>$access_token,
            'data'=>$parcels_details,
        ];
    }
}
