<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddChecksToScooterParts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scooter_parts', function (Blueprint $table) {
            $table->dropColumn('RepairStatus')
            $table->string('300',50)->after('EmissionControlItem');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('scooter_parts', function (Blueprint $table) {
            //
        });
    }
}
