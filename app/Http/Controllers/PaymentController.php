<?php

namespace App\Http\Controllers;

use App\PaymentHistory;

class PaymentController extends Controller
{

    public function adminPayment()
    {

        $results = PaymentHistory::leftJoin('merchants', 'merchants.merchant_id', '=', 'payment_histories.merchant_id')
            ->where('is_complete', false)->get();

        return view('admin.payment.payment_request')->with('results', $results);
    }
}
