<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtherBibaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('other_bibarans', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('plan_id')->nullable();
            $table->unsignedInteger('type_id')->nullable();
            $table->string('formation_start_date');
            $table->string('formation_start_date_eng');
            $table->string('start_date');
            $table->string('start_date_eng');
            $table->string('end_date');
            $table->string('end_date_eng');
            $table->string('date');
            $table->string('date_eng');
            $table->unsignedInteger('committee_count');
            $table->unsignedInteger('house_family_count');
            $table->unsignedInteger('female');
            $table->unsignedInteger('male');
            $table->unsignedInteger('post_id');
            $table->unsignedInteger('staff_id');
            $table->unsignedInteger('user_id');
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
        Schema::dropIfExists('other_bibarans');
    }
}
