<?php

namespace App\Http\Controllers;

use App\Merchant;

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
        return view('admin.merchant.edit')->with('result', $result);
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

    public function try($id)
    {


        return $id;
        $result = Merchant::orderBy('created_at', 'DESC')->get();
        return view('admin.merchant.index')->with('results', $result);
    }
}
