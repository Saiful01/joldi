<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentMethoedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_methoeds', function (Blueprint $table) {
            $table->bigIncrements('paymentmethoed_id');
            $table->string('payment_methoed_name');
            $table->string('account_number');
            $table->string('branch_address')->nullable();
            $table->string('payee_name')->nullable();


            $table->unsignedBigInteger('merchant_id');

            $table->foreign('merchant_id')->references('merchant_id')->on('merchants');


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
        Schema::dropIfExists('payment_methoeds');
    }
}
