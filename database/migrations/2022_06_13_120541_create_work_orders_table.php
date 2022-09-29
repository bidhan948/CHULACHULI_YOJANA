<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('plan_id');
            $table->unsignedInteger('work_order_no')->nullable();
            $table->string('name');
            $table->string('decision_date_nep',155)->nullable();
            $table->string('decision_date_eng',155)->nullable();
            $table->double('municipality_amount')->default(0);
            $table->double('cost_participation')->default(0);
            $table->double('cost_sharing')->default(0);
            $table->string('cost_sharing_name')->nullable();
            $table->string('date_nep',155)->nullable();
            $table->string('date_eng',155)->nullable();
            $table->string('program_start_date_nep',155)->nullable();
            $table->string('program_start_date_eng',155)->nullable();
            $table->string('program_end_date_nep',155)->nullable();
            $table->string('program_end_date_eng',155)->nullable();
            $table->double('work_order_budget')->default(0);
            $table->unsignedInteger('list_registrationm_attribute_id')->nullable();
            $table->unsignedInteger('house_family_count')->default();
            $table->unsignedInteger('female')->default();
            $table->unsignedInteger('male')->default();
            $table->unsignedInteger('entered_by')->nullable();
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
        Schema::dropIfExists('work_orders');
    }
}
