<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListRegistrationAttributeDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_registration_attribute_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('list_registration_attribute_id');
            $table->string('contact_no', 155)->nullable();
            $table->unsignedInteger('post_id')->nullable();
            $table->string('name')->nullable();
            $table->unsignedInteger('ward_no')->nullable();
            $table->enum('gender', ['female', 'male', 'other'])->nullable();
            $table->string('cit_no',100)->nullable();
            $table->string('issue_district')->nullable();
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
        Schema::dropIfExists('list_registration_attribute_details');
    }
}
