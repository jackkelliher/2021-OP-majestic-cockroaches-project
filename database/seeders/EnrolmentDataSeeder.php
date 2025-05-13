<?php

namespace Database\Seeders;

use App\Enrolment;
use App\EnrolmentData;
use Illuminate\Database\Seeder;

class EnrolmentDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        echo "Seeding Enrolment Data\n";
        $enrolment = Enrolment::all();
        foreach ($enrolment as $e) {
            EnrolmentData::create(array(
                'enrolmentId' => $e->id,
                'cohortId' => $e->cohortId,
                'studentId' => $e->studentId
            ));
        }
        $ed= EnrolmentData::all();
        foreach($ed as $e){
            $e->setObjects();
        }
    }
}
