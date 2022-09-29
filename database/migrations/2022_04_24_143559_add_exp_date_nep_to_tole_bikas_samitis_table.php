<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExpDateNepToToleBikasSamitisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tole_bikas_samitis', function (Blueprint $table) {
            $table->string('exp_date_nep')->nullable();
            $table->string('exp_date_eng')->nullable();
            $table->unsignedInteger('reg_no');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tole_bikas_samitis', function (Blueprint $table) {
            //
        });
    }
}
