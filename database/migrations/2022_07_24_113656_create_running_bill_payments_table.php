<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRunningBillPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('running_bill_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('plan_id');
            $table->unsignedInteger('type_id');
            $table->unsignedInteger('period');
            $table->boolean('is_aouto_calculate')->default(true);
            $table->string('bill_date_nep', 150);
            $table->string('bill_date_eng', 150);
            $table->double('est_amount');
            $table->double('plan_evaluation_amount');
            $table->double('plan_own_evaluation_amount');
            $table->double('payable_amount');
            $table->double('peski_amount');
            $table->double('contingency_amount');
            $table->double('total_katti_amount');
            $table->double('total_paid_amount');
            $table->string('bill_payable_date',150);
            $table->string('bill_payable_date_eng', 150);
            $table->unsignedInteger('user_id')->nullable();
            $table->string('ip')->nullable();
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
        Schema::dropIfExists('running_bill_payments');
    }
}
