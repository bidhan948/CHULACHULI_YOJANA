<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractKulLagatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_kul_lagats', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('plan_id');
            $table->unsignedInteger('kabol_id');
            $table->unsignedInteger('physical_amount');
            $table->unsignedInteger('unit_id');
            $table->unsignedInteger('grant_amount');
            $table->unsignedInteger('total_kabol_amount');
            $table->string('contractor_name');
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
        Schema::dropIfExists('contract_kul_lagats');
    }
}
