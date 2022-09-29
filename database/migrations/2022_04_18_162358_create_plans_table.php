<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('reg_no');
            $table->text('name')->nullable();
            $table->unsignedInteger('fiscal_year_id')->default(getCurrentFiscalYear(true)->id);
            $table->unsignedInteger('expense_type_id');
            $table->unsignedInteger('type_id');
            $table->unsignedInteger('topic_area_type_id');
            $table->unsignedInteger('topic_of_grant_id');
            $table->unsignedInteger('topic_of_allocation_id');
            $table->float('grant_amount');
            $table->float('first_installment')->nullable();
            $table->float('second_installment')->nullable();
            $table->float('third_installment')->nullable();
            $table->float('fourth_installment')->nullable();
            $table->text('detail')->nullable();
            $table->boolean('is_cancel')->default(false);
            $table->integer('added_by')->nullable();
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
        Schema::dropIfExists('plans');
    }
}
