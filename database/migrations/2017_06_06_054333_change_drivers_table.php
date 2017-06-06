<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('drivers', function (Blueprint $table) {
            $table->dropColumn('firstname');
            $table->dropColumn('surname');
            $table->dropColumn('email');
            $table->dropColumn('phone');
            $table->dropColumn('passport_number');
            $table->dropColumn('international');

            $table->string('address',150)->after('user_id');
            $table->date('date_of_birth')->after('user_id');
            $table->date('expiry_date')->after('drivers_licence');
            $table->string('licence_state',25)->after('drivers_licence');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('drivers', function (Blueprint $table) {
            $table->dropColumn('address');
            $table->dropColumn('date_of_birth');
            $table->dropColumn('expiry_date');
            $table->dropColumn('licence_state');
        });
    }
}
