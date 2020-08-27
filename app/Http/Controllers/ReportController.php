<?php

namespace App\Http\Controllers;

use App\Merchant;
use App\ParcelStatus;
use Illuminate\Http\Request;
use App\Parcel;

class ReportController extends Controller
{
    public function consignmentReport(Request $request)
    {
        if($request->isMethod('post')){
            $form= $request['from'];
            $to= $request['to'];
            $par_count = Parcel::whereBetween('created_at', [$form, $to])->count();
            $delivery_pending = ParcelStatus::whereBetween('created_at', [$form, $to])->where('delivery_status', 'pending')->count();
            $pickup_man_assigned = ParcelStatus::whereBetween('created_at', [$form, $to])->where('delivery_status', 'pickup_man_assigned')->count();
            $delivery_man_assigned = ParcelStatus::whereBetween('created_at', [$form, $to])->where('delivery_status', 'delivery_man_assigned')->count();
            $delivery_accepted = ParcelStatus::whereBetween('created_at', [$form, $to])->where('delivery_status', 'accepted')->count();
            $delivery_cancelled = ParcelStatus::whereBetween('created_at', [$form, $to])->where('delivery_status', 'cancelled')->count();
            $delivery_on_the_way = ParcelStatus::whereBetween('created_at', [$form, $to])->where('delivery_status', 'on_the_way')->count();
            $delivery_delivered = ParcelStatus::whereBetween('created_at', [$form, $to])->where('delivery_status', 'delivered')->count();
            $delivery_returned = ParcelStatus::whereBetween('created_at', [$form, $to])->where('delivery_status', 'returned')->count();
            $delivery_returned_to_admin = ParcelStatus::whereBetween('created_at', [$form, $to])->where('delivery_status', 'returned_to_admin')->count();
            $delivery_partial_delivered = ParcelStatus::whereBetween('created_at', [$form, $to])->where('delivery_status', 'partial_delivered')->count();
            return view('admin.reports.show')
                ->with('par_count', $par_count)
                ->with('delivery_pending', $delivery_pending)
                ->with('pickup_man_assigned', $pickup_man_assigned)
                ->with('delivery_man_assigned', $delivery_man_assigned)
                ->with('delivery_on_the_way', $delivery_on_the_way)
                ->with('delivery_cancelled', $delivery_cancelled)
                ->with('delivery_delivered', $delivery_delivered)
                ->with('delivery_returned', $delivery_returned)
                ->with('delivery_returned_to_admin', $delivery_returned_to_admin)
                ->with('delivery_partial_delivered', $delivery_partial_delivered)
                ->with('delivery_accepted', $delivery_accepted);

        }


    else{
        $par_count = Parcel::count();
        $delivery_pending = ParcelStatus::where('delivery_status', 'pending')->count();
        $pickup_man_assigned = ParcelStatus::where('delivery_status', 'pickup_man_assigned')->count();
        $delivery_man_assigned = ParcelStatus::where('delivery_status', 'delivery_man_assigned')->count();
        $delivery_accepted = ParcelStatus::where('delivery_status', 'accepted')->count();
        $delivery_cancelled = ParcelStatus::where('delivery_status', 'cancelled')->count();
        $delivery_on_the_way = ParcelStatus::where('delivery_status', 'on_the_way')->count();
        $delivery_delivered = ParcelStatus::where('delivery_status', 'delivered')->count();
        $delivery_returned = ParcelStatus::where('delivery_status', 'returned')->count();
        $delivery_returned_to_admin = ParcelStatus::where('delivery_status', 'returned_to_admin')->count();
        $delivery_partial_delivered = ParcelStatus::where('delivery_status', 'partial_delivered')->count();
        return view('admin.reports.show')
            ->with('par_count', $par_count)
            ->with('delivery_pending', $delivery_pending)
            ->with('pickup_man_assigned', $pickup_man_assigned)
            ->with('delivery_man_assigned', $delivery_man_assigned)
            ->with('delivery_on_the_way', $delivery_on_the_way)
            ->with('delivery_cancelled', $delivery_cancelled)
            ->with('delivery_delivered', $delivery_delivered)
            ->with('delivery_returned', $delivery_returned)
            ->with('delivery_returned_to_admin', $delivery_returned_to_admin)
            ->with('delivery_partial_delivered', $delivery_partial_delivered)
            ->with('delivery_accepted', $delivery_accepted);
    }

    }
}
