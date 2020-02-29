<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Merchant extends Authenticatable{

use Notifiable;
    protected $primaryKey = 'merchant_id';


    public $timestamps=true;
    protected $guarded=[];

}
