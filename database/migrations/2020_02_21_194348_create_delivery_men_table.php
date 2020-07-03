<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryMenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_men', function (Blueprint $table) {
            $table->bigIncrements('delivery_man_id');
            $table->string('delivery_man_name');
            $table->string('delivery_man_email');
            $table->string('delivery_man_phone');
            $table->string('delivery_man_type');
            $table->string('password');
            $table->string('delivery_man_address');
            $table->string('delivery_man_image')->nullable();
            $table->string('delivery_man_document')->nullable();
            $table->string('license')->nullable();
            $table->string('tax_token')->nullable();
            $table->string('blue_book')->nullable();
            $table->string('insurence')->nullable();
            $table->boolean('active_status')->default(true);
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
        Schema::dropIfExists('delivery_men');
    }
}
