<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstitutionalCommitteeDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institutional_committee_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('institutional_committee_id');
            $table->unsignedInteger('post_id');
            $table->string('name');
            $table->unsignedInteger('ward_no');
            $table->enum('gender', ['female', 'male', 'other']);
            $table->string('cit_no',155)->nullable();
            $table->string('issue_district')->nullable();
            $table->string('mobile_no')->nullable();
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
        Schema::dropIfExists('institutional_committee_details');
    }
}
