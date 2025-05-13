<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Database\Seeders\EnrolmentCodeSeeder;

class CreateEnrolmentCodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'enrolment_code',
            function (Blueprint $table) {
                $table->increments('id');
                $table->string('status');
            }
        );
        $seeder = new EnrolmentCodeSeeder();
        $seeder->run();
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enrolment_code');
    }
}
