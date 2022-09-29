<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddDeadlinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('add_deadlines', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedInteger('plan_id');
            $table->unsignedInteger('period');
            $table->string('consumer_date_nep',100)->nullable();
            $table->string('consumer_date_eng',100)->nullable();
            $table->string('institution_date_add_nep',100)->nullable();
            $table->string('institution_date_add_eng',100)->nullable();
            $table->string('period_add_date_nep',100)->nullable();
            $table->string('period_add_date_eng',100)->nullable();
            $table->text('remark')->nullable();
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
        Schema::dropIfExists('add_deadlines');
    }
}
