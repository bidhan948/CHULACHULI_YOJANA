<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmanatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amanats', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('place');
            $table->unsignedInteger('ward_no')->nullable();
            $table->string('cit_no',155)->nullable();
            $table->string('issue_district')->nullable();
            $table->string('mobile_no',155)->nullable();
            $table->enum('gender',['female','male','other'])->nullable();
            $table->unsignedInteger('entered_by');
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
        Schema::dropIfExists('amanats');
    }
}
