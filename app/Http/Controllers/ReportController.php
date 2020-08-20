<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Parcel;

class ReportController extends Controller
{
    public function consignmentReport(Request $request)
    {
        if($request->isMethod('post')){


            return "Post";
        }


        return $number_of_parcel=Parcel::count();
        return $number_of_parcel=Parcel::count();
      
    }
}
