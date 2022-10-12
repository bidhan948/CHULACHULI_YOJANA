<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractOpensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_opens', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('plan_id');
            $table->string('name');
            $table->string('bank_name');
            $table->unsignedInteger('bank_guarantee_amount');
            $table->string('bank_date');
            $table->unsignedInteger('bail_amount');
            $table->string('remark');
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
        Schema::dropIfExists('contract_opens');
    }
}
