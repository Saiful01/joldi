<?php

namespace App\Http\Controllers;

use App\Merchant;
use App\Parcel;
use App\ParcelStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class DashboardController extends Controller
{
    //

    public function _construct()
    {
        // $this->middleware('auth');
    }

    public function dashboard()
    {

        $par_count = Parcel::count();
        $merchant_count = Merchant::count();
        $delivery_pending = ParcelStatus::where('delivery_status', 'pending')->count();
        $delivery_accepted = ParcelStatus::where('delivery_status', 'accepted')->count();
        $delivery_cancelled = ParcelStatus::where('delivery_status', 'cancelled')->count();
        $delivery_on_the_way = ParcelStatus::where('delivery_status', 'on_the_way')->count();
        $delivery_delivered = ParcelStatus::where('delivery_status', 'delivered')->count();
        $delivery_returned = ParcelStatus::where('delivery_status', 'returned')->count();

        $payable_amount = Parcel::join('parcel_statuses', 'parcel_statuses.parcel_id', '=', 'parcels.parcel_id')
            ->where('is_complete', true)
            ->where('delivery_status', "delivered")
            ->where('is_paid_to_merchant', "pending")
            //->whereBetween('parcels.created_at', [$date_from->format('Y-m-d') . " 00:00:00", $date_to->format('Y-m-d') . " 23:59:59"])
            ->sum('payable_amount');

        $total_sales = Parcel::join('parcel_statuses', 'parcel_statuses.parcel_id', '=', 'parcels.parcel_id')
            ->where('is_complete', true)
            ->where('delivery_status', "delivered")
            ->where('is_paid_to_merchant', "pending")
            //->whereBetween('parcels.created_at', [$date_from->format('Y-m-d') . " 00:00:00", $date_to->format('Y-m-d') . " 23:59:59"])
            ->sum('total_amount');

        /*  $payable_amount = Parcel::join('parcel_statuses', 'parcel_statuses.parcel_id', '=', 'parcels.parcel_id')
             /* ->where('is_complete', true)
              ->where('delivery_status', "delivered")
              ->where('is_paid_to_merchant', "pending")
              ->whereBetween('parcels.created_at', [$date_from->format('Y-m-d') . " 00:00:00", $date_to->format('Y-m-d') . " 23:59:59"])
              ->sum(DB::raw('payable_amount-(cod + delivery_charge)'));*/


        $sum = Parcel::sum('total_amount');
        $total_delivery_charge = Parcel::sum('delivery_charge');
        $parcel_list = Parcel::join('parcel_statuses', 'parcel_statuses.parcel_id', '=', 'parcels.parcel_id')
            ->join('customers', 'parcel_statuses.customer_id', '=', 'customers.customer_id')
            ->orderBy('parcels.created_at', "DESC")
            ->limit(10)
            ->get();

        return view('admin.dashboard.index')
            ->with('par_count', $par_count)
            ->with('merchant_count', $merchant_count)
            ->with('delivery_pending', $delivery_pending)
            ->with('delivery_accepted', $delivery_accepted)
            ->with('delivery_cancelled', $delivery_cancelled)
            ->with('delivery_on_the_way', $delivery_on_the_way)
            ->with('delivery_delivered', $delivery_delivered)
            ->with('delivery_returned', $delivery_returned)
            ->with('payable_amount', $payable_amount)
            ->with('total_sales', $total_sales)
            ->with('parcel_list', $parcel_list)
            ->with('total_delivery_charge', $total_delivery_charge)
            ->with('total_amount', $total_sales)
            ->with('sum', $sum);

    }

    public function logout()
    {
        Auth::logout();
        Auth::guard('merchant')->logout();
        return Redirect::to('/');


    }
}
