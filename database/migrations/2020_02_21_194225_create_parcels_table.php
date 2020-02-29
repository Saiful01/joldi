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
            $table->double('payable_amount')->nullable();


            $table->double('delivery_charge')->default(0);
            $table->double('cod')->default(0);
            $table->double('total_amount')->nullable();//Not Needed

            $table->boolean('is_same_day')->default(true);
            $table->date('delivery_date')->nullable();
            $table->string('parcel_notes')->nullable();

            $table->foreign('parcel_type_id')->references('parcel_type_id')->on('parcel_types');

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
