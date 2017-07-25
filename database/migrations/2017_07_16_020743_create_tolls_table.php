<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tolls', function (Blueprint $table) {
            $table->increments('id');
            $table->date('Date');
            $table->string('Time',15);
            $table->string('LicencePlate',15);
            $table->string('Tag',10);
            $table->string('TagName',10);
            $table->string('Group',25);
            $table->string('On',25);
            $table->integer('Lane');
            $table->string('VehicleType',25);
            $table->float('Amount',8,2);
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
        Schema::dropIfExists('tolls');
    }
}
