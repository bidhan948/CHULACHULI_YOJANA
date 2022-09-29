<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsumerDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consumer_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('consumer_id');
            $table->unsignedInteger('post_id');
            $table->string('name');
            $table->unsignedInteger('ward_no');
            $table->unsignedInteger('gender');
            $table->string('cit_no');
            $table->string('issue_district');
            $table->string('contact_no');
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
        Schema::dropIfExists('consumer_details');
    }
}
