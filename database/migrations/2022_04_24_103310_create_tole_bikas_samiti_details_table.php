<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToleBikasSamitiDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tole_bikas_samiti_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('tole_bikas_samiti_id');
            $table->unsignedInteger('position');
            $table->string('name');
            $table->unsignedInteger('ward_no');
            $table->unsignedInteger('gender');
            $table->string('cit_no')->nullable();
            $table->string('issue_district')->nullable();
            $table->string('contact_no')->nullable();
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
        Schema::dropIfExists('tole_bikas_samiti_details');
    }
}
