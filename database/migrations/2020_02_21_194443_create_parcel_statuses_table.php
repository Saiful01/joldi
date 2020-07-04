<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParcelStatusesTable extends Migration
{
    /**
     * Run the migrations.ti-home
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parcel_statuses', function (Blueprint $table) {
            $table->bigIncrements('parcel_status_id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('parcel_id');
            $table->string('delivery_status')->default('pending');//pending,pickup_man_assigned,accepted(Qrcode Scan), hub_received, cancelled, delivery_man_assigned, on_the_way (Picked Up By DeliveryMan/ Qrcode Scan), delivered,returned,partial_delivered, returned_to_admin
            $table->unsignedBigInteger('delivery_man_id')->nullable();
            $table->unsignedBigInteger('order_pickup_man_id')->nullable();
            $table->unsignedBigInteger('hub_receiver')->nullable();
            $table->boolean('is_complete')->default(false);// Amount collected from Customer
            $table->string('is_paid_to_merchant')->default("pending"); //pending , requested, received //Merchant K pay kora hoise kina seta

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
        Schema::dropIfExists('parcel_statuses');
    }
}
