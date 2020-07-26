<?php

use Carbon\Carbon;

function statusFormat($status)
{

    return ucfirst(str_replace('_', ' ', $status));;
}

function getMerchantActiveMessage()
{
    return " your account have been successfully verified. Start your delivery today ";
}


function getDateFormat($date)
{

    $createdAt = Carbon::parse($date);
    return $createdAt->format('d M, Y g:i A');
}
function getDateFromParcelId($parcel_id)
{


    $is_exist= \App\Parcel::where('parcel_id',$parcel_id)->first();
    if(is_null($is_exist)){
        return "-";
    }else{
        $is_exist->created_at;
    }

}


function getDeliveryManNameFromId($id)
{
    $is_exist = \App\DeliveryMan::where('delivery_man_id', $id)->first();
    if (is_null($is_exist)) {
        return "-";
    } else {
        return $is_exist->delivery_man_name;
    }
}

function getUserNameFromId($id)
{
    $is_exist = \App\User::where('id', $id)->first();
    if (is_null($is_exist)) {
        return "-";
    } else {
        return $is_exist->name;
    }
}

function getFormattedStatus($status)
{

    return strtoupper(str_replace('_', ' ', $status));
}


//https://stackoverflow.com/questions/28290332/best-practices-for-custom-helpers-in-laravel-5
?>
