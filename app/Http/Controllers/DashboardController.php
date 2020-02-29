<?php

namespace App\Http\Controllers;

use App\Parcel;
use App\ParcelStatus;
use App\PaymentHistory;
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
         $delivery_pending = ParcelStatus::where('delivery_status','pending')->count();
        $delivery_accepted = ParcelStatus::where('delivery_status','accepted')->count();
        $delivery_cancelled = ParcelStatus::where('delivery_status','cancelled')->count();
        $delivery_ontheway = ParcelStatus::where('delivery_status','on_the_way')->count();
        $delivery_delivered = ParcelStatus::where('delivery_status','delivered')->count();
        $delivery_returned = ParcelStatus::where('delivery_status','returned')->count();


      $sum = Parcel::sum('total_amount');

        return view('admin.dashboard.index')
            ->with('par_count',$par_count)
            ->with('delivery_pending',$delivery_pending)
            ->with('delivery_accepted',$delivery_accepted)
            ->with('delivery_cancelled',$delivery_cancelled)
            ->with('delivery_ontheway',$delivery_ontheway)
            ->with('delivery_delivered',$delivery_delivered)
            ->with('delivery_returned',$delivery_returned)
            ->with('sum',$sum);

    }

    public function logout()
    {
        Auth::logout();
        return Redirect::to('/login');


    }
}
