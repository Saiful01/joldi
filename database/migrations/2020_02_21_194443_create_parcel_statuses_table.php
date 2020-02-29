<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParcelStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parcel_statuses', function (Blueprint $table) {
            $table->bigIncrements('parcel_status_id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('parcel_id');
            $table->string('delivery_status')->default('pending');
            $table->string('delivery_man_id')->nullable();
            $table->boolean('is_complete')->default(false);// Amount collected from Cystomer
            $table->string('is_paid_to_merchant')->default("pending"); //pending,requested, accepted, received //Merchant K pay kora hoise kina seta

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
