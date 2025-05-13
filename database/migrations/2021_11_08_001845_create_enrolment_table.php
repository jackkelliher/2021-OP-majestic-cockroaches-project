<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Database\Seeders\EnrolmentSeeder;

class CreateEnrolmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrolment', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->integer('cohortId')->foreign('cohortId')->references('id')->on('cohorts');
            $table->integer('studentId')->foreign('studentId')->references('id')->on('students');
        });

        $seeder = new EnrolmentSeeder();
        $seeder->run();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enrolment');
    }
}
