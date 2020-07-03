<?php

use Carbon\Carbon;

function statusFormat($status)
{

    return ucfirst(str_replace('_', ' ', $status));;
}
function getMerchantActiveMessage(){
    return " your account have been successfully verified. Start your delivery today ";
}


function getDateFormat($date)
{

    $createdAt = Carbon::parse($date);
    return $createdAt->format('d M, Y g:i A');
}





//https://stackoverflow.com/questions/28290332/best-practices-for-custom-helpers-in-laravel-5
?>
