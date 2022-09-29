<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advances', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('plan_id');
            $table->double('peski_amount');
            $table->string('peski_given_date_nep',100)->nullable();
            $table->string('peski_given_date_eng',100)->nullable();
            $table->string('advance_paid_date_nep',100)->nullable();
            $table->string('advance_paid_date_eng',100)->nullable();
            $table->string('father_name')->nullable();
            $table->string('g_father_name')->nullable();
            $table->unsignedInteger('user_id');
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
        Schema::dropIfExists('advances');
    }
}
