<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Database\Seeders\CohortSeeder;

class CreateCohortsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cohorts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->nullable();
            $table->integer('lecturerId')->foreign('lecturerId')->references('id')->on('lecturers')->nullable();
            $table->string('subject')->foreign('subject')->references('name')->on('papers');
            $table->string('year');
            $table->string('semester');
            $table->string('stream')->default('A');
            $table->timestamps();
        });
        $seeder = new CohortSeeder();
        $seeder->run();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cohorts');
    }
}
