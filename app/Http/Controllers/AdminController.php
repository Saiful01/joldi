<?php

namespace App\Http\Controllers;

use App\Area;
use App\DeliveryMan;
use App\Merchant;
use App\Parcel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //

    public function merchants()
    {

        $result = Merchant::orderBy('created_at', 'DESC')->get();
        return view('admin.merchant.index')->with('results', $result);
    }

    public function merchantEdit($id)
    {

        $result = Merchant::where('merchant_id', $id)->first();
        $results = Area::where('area_id', $id)->get();
        return view('admin.merchant.edit')
            ->with('areas', $results)
            ->with('result', $result);

    }

    public function merchantInactive($id)
    {

        try {
            Merchant::where('merchant_id', $id)->update([
                'active_status' => false
            ]);

            return back()->with('success', "Successfully Inactive");
        } catch (\Exception $exception) {

            return back()->with('success', $exception->getMessage());
        }
    }

    public function merchantActivate($id)
    {

        try {
            Merchant::where('merchant_id', $id)->update([
                'active_status' => true
            ]);

            return back()->with('success', "Successfully Activate");
        } catch (\Exception $exception) {

            return back()->with('success', $exception->getMessage());
        }
    }

    public function deliverymanInactive($id)
    {

        try {
            DeliveryMan::where('delivery_man_id', $id)->update([
                'active_status' => false
            ]);

            return back()->with('success', "Successfully Inactive");
        } catch (\Exception $exception) {

            return back()->with('success', $exception->getMessage());
        }
    }

    public function deliverymanActivate($id)
    {

        try {
            DeliveryMan::where('delivery_man_id', $id)->update([
                'active_status' => true
            ]);

            return back()->with('success', "Successfully Activate");
        } catch (\Exception $exception) {

            return back()->with('success', $exception->getMessage());
        }
    }

    public function try($id)
    {


        return $id;
        $result = Merchant::orderBy('created_at', 'DESC')->get();
        return view('admin.merchant.index')->with('results', $result);
    }

    public function merchantUpdate(Request $request)
    {
        return $request;

        $request['password'] = Hash::make($request['merchant_password']);
        unset($request['_token']);
        unset($request['merchant_password']);;
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
                'active_status' => $request['active_status'],
                'area_id' => $request['area_id'],
                'is_cod_enable' => $request['is_cod_enable'],
                'cod_charge' => $request['cod_charge'],
                'image' => $image_name,
            ];
        } else {
            $array = [
                'merchant_name' => $request['merchant_name'],
                'merchant_phone' => $request['merchant_phone'],
                'password' => $request['password'],
                'merchant_email' => $request['merchant_email'],
                'active_status' => $request['active_status'],
                'area_id' => $request['area_id'],
                'is_cod_enable' => $request['is_cod_enable'],
                'cod_charge' => $request['cod_charge'],

            ];
        }

        try {
            Merchant::where('merchant_id', $request['merchant_id'])->update($request->all());;
            return back()->with('success', "Successfully updated");
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

    }

    public function merchantProfile($id)
    {

        $result = Merchant::where('merchant_id', $id)->first();
        $results = Area::where('area_id', $id)->get();
        $parcel_list = Parcel::join('parcel_statuses', 'parcel_statuses.parcel_id', '=', 'parcels.parcel_id')
            ->join('customers', 'parcel_statuses.customer_id', '=', 'customers.customer_id')
            ->orderBy('parcels.created_at', "DESC")
            ->limit(10)
            ->get();

        return view('admin.merchant.profile')
            ->with('result', $result)
            ->with('results', $results)
            ->with('parcel_list', $parcel_list);


    }
}
