<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramAdvancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_advances', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('work_order_id');
            $table->string('name');
            $table->string('father_name')->nullable();
            $table->string('g_father_name')->nullable();
            $table->double('amount');
            $table->string('advance_given_date_nep',100);
            $table->string('advance_given_date_eng',100)->nullable();
            $table->string('advance_paid_date_nep',100);
            $table->string('advance_paid_date_eng',100)->nullable();
            $table->text('remark')->nullable();
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
        Schema::dropIfExists('program_advances');
    }
}
