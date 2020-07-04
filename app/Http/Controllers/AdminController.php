<?php

namespace App\Http\Controllers;

use App\Area;
use App\DeliveryMan;
use App\Merchant;
use App\Parcel;
use App\PaymentMethoed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    //
    public function sameDaySearch(){
        $parcels = Parcel::join('parcel_statuses', 'parcel_statuses.parcel_id', '=', 'parcels.parcel_id')
            ->join('customers', 'parcel_statuses.customer_id', '=', 'customers.customer_id')
            ->leftJoin('delivery_men', 'delivery_men.delivery_man_id', '=', 'parcel_statuses.delivery_man_id')
            ->Join('areas', 'areas.area_id', '=', 'parcels.area_id')
            ->where('parcels.is_same_day', true)
            ->get();
        $delivery_mans = DeliveryMan::where('active_status', true)->get();
        $areas= Area::get();

        return view('admin.consignment.show')
            ->with('delivery_mans', $delivery_mans)
            ->with('areas', $areas)
            ->with('results', $parcels);

    }
    public function nextDaySearch(){
        $parcels = Parcel::join('parcel_statuses', 'parcel_statuses.parcel_id', '=', 'parcels.parcel_id')
            ->join('customers', 'parcel_statuses.customer_id', '=', 'customers.customer_id')
            ->leftJoin('delivery_men', 'delivery_men.delivery_man_id', '=', 'parcel_statuses.delivery_man_id')
            ->Join('areas', 'areas.area_id', '=', 'parcels.area_id')
            ->where('parcels.is_same_day', false)
            ->get();
        $delivery_mans = DeliveryMan::where('active_status', true)->get();
        $areas= Area::get();

        return view('admin.consignment.show')
            ->with('delivery_mans', $delivery_mans)
            ->with('areas', $areas)
            ->with('results', $parcels);

    }
    public function invoiceSearch(Request $request){
        $invoice=$request['invoice'];
        $parcels = Parcel::where('parcel_invoice','LIKE','%'.$invoice.'%')
            ->join('parcel_statuses', 'parcel_statuses.parcel_id', '=', 'parcels.parcel_id')
            ->join('customers', 'parcel_statuses.customer_id', '=', 'customers.customer_id')
            ->leftJoin('delivery_men', 'delivery_men.delivery_man_id', '=', 'parcel_statuses.delivery_man_id')
            ->Join('areas', 'areas.area_id', '=', 'parcels.area_id')
            ->get();
        $delivery_mans = DeliveryMan::where('active_status', true)->get();
        $areas= Area::get();

        return view('admin.consignment.show')
            ->with('delivery_mans', $delivery_mans)
            ->with('results', $parcels)
            ->with('areas', $areas)
            ->with('invoice', $invoice);

    }
    public function areaSearch(Request $request){
          $area=$request['area_id'];
           $parcels = Parcel::join('parcel_statuses', 'parcel_statuses.parcel_id', '=', 'parcels.parcel_id')
             /*  ->Join('areas', 'areas.area_id', '=', 'parcels.area_id')*/
               ->join('customers', 'parcel_statuses.customer_id', '=', 'customers.customer_id')
            ->leftJoin('delivery_men', 'delivery_men.delivery_man_id', '=', 'parcel_statuses.delivery_man_id')            ->Join('areas', 'areas.area_id', '=', 'parcels.area_id')
               ->where('areas.area_id','LIKE','%'.$area.'%')
            ->get();
        $delivery_mans = DeliveryMan::where('active_status', true)->get();
        $areas= Area::get();

        return view('admin.consignment.show')
            ->with('delivery_mans', $delivery_mans)
            ->with('results', $parcels)
            ->with('areas', $areas)
            ->with('area', $area);

    }

    public function merchants()
    {

        $result = Merchant::orderBy('created_at', 'DESC')->get();
        return view('admin.merchant.index')->with('results', $result);
    }

    public function merchantEdit($id)
    {

        $result = Merchant::where('merchant_id', $id)->first();
        $results = Area::get();
        return view('admin.merchant.edit')
            ->with('areas', $results)
            ->with('result', $result);

    }
    public function changeMerchant( Request $request){
        if (!$request['merchant_id']) {
            return back()->with('failed', "Please select atleast 1 item");
        }


        if($request['change']==1){
            try {

                foreach ($request['merchant_id'] as $merchant_id){

                    //echo $merchant_id;

                    $this->merchantActivate($merchant_id);


                    //Change here

                }
                return back()->with('success', "Successfully Active");

            }
            catch (\Exception $exception){
                return back()->with('failed', $exception->getMessage());
            }






            //Active
        }else{
            try {
                //Inactive
                foreach ($request['merchant_id'] as $merchant_id){

                    //echo $merchant_id;

                    $this->merchantInactive($merchant_id);


                    //Change here


                }
                return back()->with('success', "Successfully Inactive");


            }
            catch (\Exception $exception){
                return back()->with('failed', $exception->getMessage());
            }


        }


        //return $request->all();
    }
    public function deliverymanChange( Request $request){
        if (!$request['delivery_man_id']) {
            return back()->with('failed', "Please select atleast 1 item");
        }

        if($request['change']==1){

            foreach ($request['delivery_man_id'] as $delivery_man_id){

                $this->deliverymanActivate($delivery_man_id);
            }
            return back()->with('success', "Successfully Active");
        }else{
            foreach ($request['delivery_man_id'] as $delivery_man_id){
                $this->deliverymanInactive($delivery_man_id);

            }
            return back()->with('success', "Successfully Inactive");
        }
    }

    public function merchantInactive( $id)
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
         $merchant =  Merchant::where('merchant_id', $id)->first();
            Merchant::where('merchant_id', $id)->update([
                'active_status' => true
            ]);
            //TODO::send email with confirmation url to u
            $to_email = $merchant->merchant_email;

            $data = array(
                'name' => $merchant->merchant_name,
                'body' => getMerchantActiveMessage()
            );

            Mail::send('mail', $data, function ($message) use ($to_email) {

                $message->to($to_email);
                $message->subject('Account Verified mail');

            });
            return back()->with('success', "Successfully Active");
        } catch (\Exception $exception) {

            return back()->with('failed', $exception->getMessage());
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

/*    public function try($id)
    {


        return $id;
        $result = Merchant::orderBy('created_at', 'DESC')->get();
        return view('admin.merchant.index')->with('results', $result);
    }*/

    public function merchantUpdate(Request $request)
    {
        //return $request;

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
        $results = Area::where('area_id', $id)->first();
        $payment_data = PaymentMethoed::where('merchant_id', Auth::guard('merchant')->id())->get();
        $parcel_list = Parcel::join('parcel_statuses', 'parcel_statuses.parcel_id', '=', 'parcels.parcel_id')
            ->join('customers', 'parcel_statuses.customer_id', '=', 'customers.customer_id')
            ->orderBy('parcels.created_at', "DESC")
            ->limit(10)
            ->get();

        return view('admin.merchant.profile')
            ->with('result', $result)
            ->with('results', $results)
            ->with('payment_data', $payment_data)
            ->with('parcel_list', $parcel_list);


    }
}
