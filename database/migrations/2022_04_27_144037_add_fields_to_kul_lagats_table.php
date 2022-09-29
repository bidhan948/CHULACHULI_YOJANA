<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToKulLagatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kul_lagats', function (Blueprint $table) {
            $table->double('napa_contingency')->nullable();
            $table->double('other_office_con')->nullable();
            $table->double('other_office_con_contingency')->nullable();
            $table->double('other_office_con_name')->nullable();
            $table->double('other_office_agreement')->nullable();
            $table->double('other_agreement_contingency')->nullable();
            $table->double('other_contingency_con_name')->nullable();
            $table->double('customer_agreement')->nullable();
            $table->double('customer_agreement_contingency')->nullable();
            $table->double('work_order_budget')->nullable();
            $table->double('consumer_budget')->default(0);
            $table->double('total_investment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kul_lagats', function (Blueprint $table) {
            //
        });
    }
}
