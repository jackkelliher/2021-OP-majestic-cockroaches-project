<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Database\Seeders\EnrolmentDataSeeder;

class CreateEnrolmentDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrolment_data', function (Blueprint $table) {
            $table->integer('enrolmentId')->foreign('enrolmentId')->references('id')->on('enrolment');
            $table->integer('cohortId')->nullable();
            $table->string('subject')->nullable();
            $table->string('year')->nullable();
            $table->string('semester')->nullable();
            $table->string('stream')->nullable();
            $table->integer('studentId')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('github')->nullable();
            $table->string('status')->nullable();
        });

        $seeder = new EnrolmentDataSeeder();
        $seeder->run();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enrolment_data');
    }
}
