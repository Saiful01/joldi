<?php

namespace App\Http\Controllers;

use App\Parcel;
use App\ParcelStatus;
use App\PaymentHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentHistoryController extends Controller
{

    public function merchantPayments()
    {

        $results = null;
        return view('merchant.payment.index')->with('results', $results);
    }


    public function paymentStore(Request $request)
    {

        $results = json_decode($request['parcels'], true);
        $array = [
            'payable_amount' => $request['payable_amount'],
            'parcels' => $request['parcels'],
            'merchant_id' => Auth::id()
        ];

        try {
            PaymentHistory::create($array);
        } catch (\Exception $exception) {

            return $exception->getMessage();
        }


        //TODO::Update on Parcel status table
        foreach ($results as $res) {
            try {
                ParcelStatus::where('parcel_id', $res['parcel_id'])
                    ->update([
                        'is_paid_to_merchant' => "requested"
                    ]);
            } catch (\Exception $exception) {
                return $exception->getMessage();
            }
        }

        return redirect()->to('/merchant/payments/request')->with('success', "Successfully Requested");

    }


    public function paymentRequest(Request $request)
    {


        if ($request->isMethod('post')) {

            $date_from = new Carbon($request['from_date']);
            $date_to = new Carbon($request['to_date']);

            $payable_list = Parcel::join('parcel_statuses', 'parcel_statuses.parcel_id', '=', 'parcels.parcel_id')
                /* ->where('is_complete', true)
                 ->where('delivery_status', "delivered")
                 ->where('is_paid_to_merchant', "pending")*/
                ->orderBy('parcels.created_at', "DESC")
                ->whereBetween('parcels.created_at', [$date_from->format('Y-m-d') . " 00:00:00", $date_to->format('Y-m-d') . " 23:59:59"])
                ->get();
            return view('merchant.payment.payment_request')
                ->with('results', $payable_list);
        } else {
            $payable_list = Parcel::join('parcel_statuses', 'parcel_statuses.parcel_id', '=', 'parcels.parcel_id')
                /* ->where('is_complete', true)
                 ->where('delivery_status', "delivered")
                 ->where('is_paid_to_merchant', "pending")*/
                ->orderBy('parcels.created_at', "DESC")
                ->get();
            return view('merchant.payment.payment_request')
                ->with('results', $payable_list);
        }


    }

    public function show()
    {
        $payment = Parcel::join('parcel_statuses', 'parcel_statuses.parcel_id', '=', 'parcels.parcel_id')->get();
        return view('merchant.payment.view')->with('results', $payment);
    }


    public function store(Request $request)
    {
        //
    }


}
