<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnugamanDetailPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anugaman_detail_plans', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('anugaman_samiti_detail_id');
            $table->unsignedInteger('plan_id');
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
        Schema::dropIfExists('anugaman_detail_plans');
    }
}
