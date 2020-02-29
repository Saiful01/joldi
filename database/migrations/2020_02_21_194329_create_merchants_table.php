<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchants', function (Blueprint $table) {
            $table->bigIncrements('merchant_id');
            $table->string('merchant_name');
            $table->string('merchant_phone');
            $table->string('password');
            $table->string('merchant_email')->nullable();
            $table->boolean('active_status')->default(false);
            $table->unsignedBigInteger('area_id');
            $table->boolean('is_cod_enable')->default(false);
            $table->double('cod_charge')->default(0);   //In percentage

            $table->foreign('area_id')->references('area_id')->on('areas');
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
        Schema::dropIfExists('merchants');
    }
}
