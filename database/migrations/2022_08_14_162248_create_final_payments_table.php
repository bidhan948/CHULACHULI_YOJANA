<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinalPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('final_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('plan_id');
            $table->boolean('is_auto_calculate')->default(true);
            $table->string('public_exam_date',100);
            $table->string('public_exam_date_eng',100)->nullable();
            $table->string('public_group_count',100)->nullable();
            $table->string('plan_end_date',100)->nullable();
            $table->string('plan_end_date_eng',100)->nullable();
            $table->string('assessment_date',100)->nullable();
            $table->string('assessment_date_eng',100)->nullable();
            $table->string('type_accept_date',100)->nullable();
            $table->string('type_accept_date_eng',100)->nullable();
            $table->string('anugaman_accept_date',100)->nullable();
            $table->string('anugaman_accept_date_eng',100)->nullable();
            $table->double('hal_mulyankan');
            $table->double('evaluated_amount');
            $table->double('final_payable_amount');
            $table->double('payment_till_now');
            $table->double('advance_payment');
            $table->double('ghati_mulyankan_amount');
            $table->double('total_bhuktani_amount');
            $table->double('final_contingency_amount');
            $table->double('final_total_amount_deducted');
            $table->double('final_total_paid_amount');
            $table->unsignedInteger('user_id')->nullable();
            $table->string('ip',155)->nullable();
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
        Schema::dropIfExists('final_payments');
    }
}
