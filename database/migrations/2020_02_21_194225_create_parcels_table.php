<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParcelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parcels', function (Blueprint $table) {
            $table->bigIncrements('parcel_id');
            $table->string('parcel_title')->nullable();
            $table->string('parcel_invoice');
            $table->unsignedBigInteger('parcel_type_id');
            $table->unsignedBigInteger('merchant_id');
            $table->unsignedBigInteger('shop_id');
            $table->unsignedBigInteger('area_id');

            $table->double('payable_amount')->nullable();//Parcel Charge

            $table->double('delivery_charge')->default(0);
            $table->double('cod')->default(0);
            $table->double('area_charge')->nullable();//area_charge
            $table->double('total_amount')->nullable();//payable_amount+delivery_charge+cod+area_charge
            $table->double('receivable_amount')->nullable();//Will be changed if Partial Delivered or Returned

            $table->boolean('is_same_day')->default(true);
            $table->date('delivery_date')->nullable();
            $table->string('parcel_notes')->nullable();
            $table->string('partial_notes')->nullable();
            $table->string('return_notes')->nullable();

            $table->foreign('parcel_type_id')->references('parcel_type_id')->on('parcel_types');
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
        Schema::dropIfExists('parcels');
    }
}
