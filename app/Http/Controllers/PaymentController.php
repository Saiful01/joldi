<?php

namespace App\Http\Controllers;

use App\ParcelStatus;
use App\PaymentHistory;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    public function adminPayment()
    {

         $results = PaymentHistory::leftJoin('merchants', 'merchants.merchant_id', '=', 'payment_histories.merchant_id')
          /*  ->where('paid_status', "pending")*/
            ->get();

        return view('admin.payment.payment_request')->with('results', $results);
    }
    public function PaymentRequestChange( Request $request){

        if($request['change']==1){

            foreach ($request['id'] as $id){

                $this->adminPaymentApprove($id);
            }
            return back()->with('success', "Successfully Active");
        }else{
            foreach ($request['id'] as $id){
                $this->adminPaymentCancel($id);

            }
            return back()->with('success', "Successfully Inactive");
        }
    }

    public function adminPaymentApprove($id)
    {

        $results = PaymentHistory::where('id', $id)->first();
        PaymentHistory::where('id', $id)->update([
            'paid_status' => "approved"
        ]);
        $parcels = json_decode($results->parcels, true);

        foreach ($parcels as $parcel) {

            try {
                ParcelStatus::where('parcel_id', $parcel['parcel_id'])
                    ->update([
                        'is_paid_to_merchant' => "received"
                    ]);
            } catch (\Exception $exception) {

                return $exception->getMessage();
            }

        }

        return back()->with('success', "Successfully Payment Done");
    }

    public function adminPaymentCancel($id)
    {

        //$results = PaymentHistory::where('id', $id)->first();
        PaymentHistory::where('id', $id)->update([
            'paid_status' => "rejected"
        ]);

        return back()->with('success', "Rejected Orders");

    }
}
