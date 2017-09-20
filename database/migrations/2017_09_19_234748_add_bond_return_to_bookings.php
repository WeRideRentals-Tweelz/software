<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBondReturnToBookings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->date('bond_return')->after('drop_off_time');
            $table->dateTime('drop_off_date')->change();
            $table->dateTime('pick_up_date')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('bond_return');
            $table->date('drop_off_date')->change();
            $table->date('pick_up_date')->change();
        });
    }
}
