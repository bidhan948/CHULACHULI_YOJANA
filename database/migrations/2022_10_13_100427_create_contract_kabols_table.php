<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractKabolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_kabols', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('plan_id');
            $table->string('contractor_name');
            $table->unsignedInteger('has_vat');
            $table->unsignedInteger('total_kabol_amount');
            $table->unsignedInteger('total_amount');
            $table->string('bank_guarantee');
            $table->unsignedInteger('bail_account_amount');
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
        Schema::dropIfExists('contract_kabols');
    }
}
