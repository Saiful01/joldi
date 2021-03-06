<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('payable_amount');
            $table->unsignedBigInteger('pay_by')->nullable();//Admin ID
            $table->longText('parcels');
            $table->unsignedBigInteger('merchant_id');
            $table->string('paid_status')->default("pending");//pending, approved, cancel
            $table->boolean('is_merchant_approved')->default(false);//Merchant Approved korle true hobe.

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_histories');
    }
}
