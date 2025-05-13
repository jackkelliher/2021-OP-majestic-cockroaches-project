<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Database\Seeders\EnrolmentStatusSeeder;
use App\EnrolmentCode;

class CreateEnrolmentStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create(
            'enrolment_status',
            function (Blueprint $table) {
                $table->integer('id')->foreign('id')->references('id')->on('enrolment');
                $table->string('statusCode')->foreign('statusCode')->references('id')->on('enrolment_code')->default($this->getDefault());
            }
        );
        $seeder = new EnrolmentStatusSeeder();
        $seeder->run();
    }

    public function getDefault()
    {
        $enrolled = EnrolmentCode::select('id')->where('status', 'Enrolled')->first();
        $enrolled = $enrolled->id;
        return $enrolled;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enrolment_status');
    }
}
