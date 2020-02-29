<?php

namespace App\Http\Controllers;

use App\Parcel;
use App\PaymentHistory;
use Illuminate\Http\Request;

class PaymentHistoryController extends Controller
{

    public function merchantPayments()
    {

        $results=null;
        return view('merchant.payment.index')->with('results',$results);
    }


    public function create()
    {
        //
    }
    public function show()
    {
        $payment= Parcel::join('parcel_statuses','parcel_statuses.parcel_id', '=', 'parcels.parcel_id')->get();
        return view('merchant.payment.view')->with('results', $payment);
    }


    public function store(Request $request)
    {
        //
    }


}
