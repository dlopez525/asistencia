<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAssistanceColumnToSchedulesRegisterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('schedules_register', function (Blueprint $table) {
            $table->char('assistance', 1)->nullable()->after('exit');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('schedules_register', function (Blueprint $table) {
            $table->dropColumn('assistance');
        });
    }
}
