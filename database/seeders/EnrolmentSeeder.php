<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Cohort;
use App\Student;
use App\Enrolment;

class EnrolmentSeeder extends Seeder
{
    public function enter($student, $class)
    {
        if ($class != null) {
            if (is_null($class->stream)) {
                $class->stream = $class->getDefault();
            }

            Enrolment::create(array(
                'cohortId' => $class->id,
                'studentId' => $student->id,

            ));
        }
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        echo "Seeding Enrolment\n";
        $students = Student::all();

        $years = Cohort::select('year')->distinct()->orderBy('year')->get();
        $minYear = $years->first()->year;
        $maxYear = $years->last()->year;
        foreach ($students as $student) {
            $startYear = rand((int)$minYear, (int)$maxYear);
            $startSem = rand(1, 3);
            if ($startSem == 3) {
                $startSem = "S";
            }
            $startYearStr = strval($startYear);
            $studio3 = Cohort::where('year', $startYearStr)->where('semester', $startSem)->where('subject', 'Studio3')->first();
            $studio4 = null;
            $studio5 = null;
            $studio6 = null;
            $year = $startYear;
            if ($startSem == "1") {
                $studio4 = Cohort::where('year', $startYearStr)->where('semester', '2')->where('subject', 'Studio4')->first();

                if ($year != $maxYear) {
                    $year += 1;
                    $yearStr = strval($year);
                    $studio5 = Cohort::where('year', $yearStr)->where('semester', '1')->where('subject', 'Studio5')->first();
                    $studio6 = Cohort::where('year', $yearStr)->where('semester', '2')->where('subject', 'Studio6')->first();
                }
            } else {
                if ($year != $maxYear) {
                    $year += 1;
                    $yearStr = strval($year);
                    $studio4 = Cohort::where('year', $yearStr)->where('semester', '1')->where('subject', 'Studio4')->first();
                    $studio5 = Cohort::where('year', $yearStr)->where('semester', '2')->where('subject', 'Studio5')->first();
                    if ($year != $maxYear) {
                        $year += 1;
                        $yearStr = strval($year);
                        $studio6 = Cohort::where('year', $yearStr)->where('semester', '1')->where('subject', 'Studio6')->first();
                    }
                }
            }

            $this->enter($student, $studio3);
            $this->enter($student, $studio4);
            $this->enter($student, $studio5);
            $this->enter($student, $studio6);
        }
    }
}
