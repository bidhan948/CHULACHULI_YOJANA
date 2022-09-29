<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListRegistrationAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_registration_attributes', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('list_registration_id');
            $table->string('name',512);
            $table->string('address')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('post')->nullable();
            $table->string('working_branch')->nullable();
            $table->string('cit_no')->nullable();
            $table->unsignedInteger('ward_no')->nullable();
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
        Schema::dropIfExists('list_registration_attributes');
    }
}
