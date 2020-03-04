<?php

namespace App\Http\Controllers;

use App\Area;
use App\Merchant;
use App\Parcel;
use App\ParcelStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class MerchantController extends Controller
{

    public function registration()
    {
        $result = Area::get();

        return view('merchant.registration.index')->with('result', $result);

    }


    public function dashboard()
    {
        $par_count = Parcel::count();
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
        $parcel_list = Parcel::join('parcel_statuses', 'parcel_statuses.parcel_id', '=', 'parcels.parcel_id')
            ->join('customers', 'parcel_statuses.customer_id', '=', 'customers.customer_id')
            ->orderBy('parcels.created_at', "DESC")
            ->limit(10)
            ->get();

        return view('merchant.dashboard.index')
            ->with('par_count', $par_count)
            ->with('delivery_pending', $delivery_pending)
            ->with('delivery_accepted', $delivery_accepted)
            ->with('delivery_cancelled', $delivery_cancelled)
            ->with('delivery_on_the_way', $delivery_on_the_way)
            ->with('delivery_delivered', $delivery_delivered)
            ->with('delivery_returned', $delivery_returned)
            ->with('payable_amount', $payable_amount)
            ->with('total_sales', $total_sales)
            ->with('parcel_list', $parcel_list)
            ->with('sum', $sum);
    }

    public function store(Request $request)
    {

        $request['password'] = Hash::make($request['merchant_password']);
        unset($request['_token']);
        unset($request['merchant_password']);

        if ($request->hasFile('merchant_image')) {

            $image = $request->file('merchant_image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/merchant');
            $image->move($destinationPath, $image_name);
            $array = [
                'merchant_name' => $request['merchant_name'],
                'merchant_phone' => $request['merchant_phone'],
                'password' => $request['password'],
                'merchant_email' => $request['merchant_email'],
                'area_id' => $request['area_id'],
                'image' => $image_name,
            ];
        } else {
            $array = [
                'merchant_name' => $request['merchant_name'],
                'merchant_phone' => $request['merchant_phone'],
                'password' => $request['password'],
                'merchant_email' => $request['merchant_email'],
                'area_id' => $request['area_id'],

            ];
        }

        try {
            Merchant::create($array);
            return back()->with('success', "Successfully Registered. Account will be verified by Admin");
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

    }


    public function merchantLogin()
    {
        return view('merchant.login.index');
    }

    public function merchantLoginCheck(Request $request)
    {
        $credentials = $request->only('merchant_email', 'password');
        if (Auth::guard('merchant')->attempt($credentials)) {
            return redirect()->intended('/merchant/dashboard');
        }

        return Redirect::to('/merchant/login')
            ->with('failed', 'Email or password is wrong.')
            ->withInput();

    }

    public function create()
    {
        return view('admin.merchant.create');
    }


    public function show(Merchant $merchant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Merchant $merchant
     * @return \Illuminate\Http\Response
     */
    public function merchantSetting(){
         $result = Merchant::where('merchant_id',Auth::guard('merchant')->id())->first();

        return view('merchant.setting.index')
            ->with('result', $result);

    }
    public function edit(Merchant $merchant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Merchant $merchant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Merchant $merchant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Merchant $merchant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Merchant $merchant)
    {
        //
    }
}
