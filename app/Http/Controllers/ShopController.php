<?php

namespace App\Http\Controllers;

use App\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('merchant.shop.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        unset($request['_token']);
        $id = Auth::guard('merchant')->id();
        $array = [
            'shop_name' => $request['shop_name'],
            'shop_address' => $request['shop_address'],
            'shop_phone' => $request['shop_phone'],
            'merchant_id' => $id
        ];
        try {
            Shop::create($array);
            return back()->with('success', "Successfully saved");
        } catch (\Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }


        Shop::create($array);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Shop $shop
     * @return \Illuminate\Http\Response
     */
    public function merchantCurrentShop(Request $request)
    {

        $id = Auth::guard('merchant')->id();
        $shop = Shop::where('merchant_id', $id)->where('shop_id', $request['shop'])->first();
        if (!is_null($shop)) {

            Session::put("shop_id", $shop->shop_id);
            Session::put("shop_name", $shop->shop_name);
        }

        return back()->with('success',"Shop Updated");


    }

    public function show(Shop $shop)
    {

        $result = Shop::where('merchant_id', Auth::guard('merchant')->id())->get();
        return view('merchant.shop.view')->with('result', $result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Shop $shop
     * @return \Illuminate\Http\Response
     */
    public function edit($shop_id)
    {
        $result = Shop::where('shop_id', $shop_id)->first();
        return view('merchant.shop.edit')->with('result', $result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Shop $shop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop)
    {
        unset($request['_token']);
        try {
            Shop::where('shop_id', $request['shop_id'])->update($request->all());
            return back()->with('success', "Successfully updated");

        } catch (\Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Shop $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Shop::where('shop_id', $id)->delete();
            return back()->with('success', "Successfully Deleted");

        } catch (\Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }
}
