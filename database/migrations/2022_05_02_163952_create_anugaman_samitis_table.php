<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnugamanSamitisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anugaman_samitis', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedInteger('ward_no')->default(0);
            $table->unsignedInteger('anugaman_samiti_type_id');
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
        Schema::dropIfExists('anugaman_samitis');
    }
}
