<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('booking_id');
            $table->date('date');
            $table->string('object',250);
            $table->string('old_value',250);
            $table->string('new_value',250);
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
        Schema::dropIfExists('booking_histories');
    }
}
