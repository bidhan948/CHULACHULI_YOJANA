<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGenderToAnugamanSamitiDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('anugaman_samiti_details', function (Blueprint $table) {
            $table->unsignedInteger('gender')->nullable();
            $table->unsignedInteger('ward_no')->nullable();
            $table->string('mobile_no')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('anugaman_samiti_details', function (Blueprint $table) {
            //
        });
    }
}
