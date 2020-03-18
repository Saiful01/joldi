<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class DeliveryMan extends Authenticatable
{

    public $primaryKey="delivery_man_id";
    public $timestamps=true;
    protected $guarded=[];
}
