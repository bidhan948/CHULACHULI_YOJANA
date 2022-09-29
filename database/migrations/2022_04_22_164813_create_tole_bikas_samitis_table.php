<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToleBikasSamitisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tole_bikas_samitis', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->unsignedInteger('ward_no');
            $table->string('date_nep')->nullable();
            $table->string('date_eng')->nullable();
            $table->string('former_addres')->nullable();
            $table->string('former_ward_no')->nullable();
            $table->unsignedInteger('entered_by')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('tole_bikas_samitis');
    }
}
