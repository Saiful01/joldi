<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParcelStatusHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parcel_status_histories', function (Blueprint $table) {
            $table->bigIncrements('parcel_status_history_id');
            $table->string('notes')->nullable();
            $table->string('message')->nullable();
            $table->string('parcel_status')->default('pending');
            $table->unsignedBigInteger('changed_by');   //User ID
            $table->unsignedBigInteger('parcel_id');
            $table->string('user_type')->default("admin");
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
        Schema::dropIfExists('parcel_status_histories');
    }
}
