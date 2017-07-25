<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLastKilometersCheckToScooters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scooters', function (Blueprint $table) {
            $table->integer('last_kilometers_check')->after('last_check');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('scooters', function (Blueprint $table) {
            $table->dropColumn('last_kilometers_check');
        });
    }
}
