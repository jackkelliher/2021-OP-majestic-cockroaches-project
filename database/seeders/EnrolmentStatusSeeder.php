<?php

namespace Database\Seeders;

use App\Cohort;
use Illuminate\Database\Seeder;
use App\Enrolment;
use App\EnrolmentStatus;
use App\EnrolmentCode;

class EnrolmentStatusSeeder extends Seeder
{
    public function randomStatus($e)
    {
        $pass = EnrolmentCode::select('id')->where('status', 'Passed')->first();
        $fail = EnrolmentCode::select('id')->where('status', 'Failed')->first();
        $drop = EnrolmentCode::select('id')->where('status', 'Withdrawn')->first();
        $pass = $pass->id;
        $fail = $fail->id;
        $drop = $drop->id;
        $status = rand(1, 100);
        if ($status > 30) {
            EnrolmentStatus::insert(['id' => $e->id, 'statusCode' => $pass]);
        } else if ($status > 10) {
            EnrolmentStatus::insert(['id' => $e->id, 'statusCode' => $fail]);
        } else {
            EnrolmentStatus::insert(['id' => $e->id, 'statusCode' => $drop]);
        }
    }
    public function enroll($e)
    {
        $enrolled = EnrolmentCode::select('id')->where('status', 'Enrolled')->first();
        $enrolled = $enrolled->id;
        EnrolmentStatus::insert(['id' => $e->id, 'statusCode' => $enrolled]);
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        echo "Seeding Enrolment Status\n";
        $enrolment = Enrolment::all();
        $cmonth = intval(date("m"));
        $cyear = intval("20" . date("y"));
        $cday = intval(date("d"));
        $semester = "S";
        if ($cmonth < 3) {
            if ($cmonth < 2 && $cday > 19) {
                $semester = "1";
            } else {
                $semester = "S";
            }
        } else if ($cmonth > 6) {
            $semester = "2";
        } else {
            $semester = "1";
        }


        foreach ($enrolment as $e) {
            $cohort = Cohort::find($e->cohortId);
            if (intval($cohort->year) < $cyear) {
                $this->randomStatus($e);
            } elseif (intval($cohort->year) > $cyear) {
                $this->enroll($e);
            } elseif (intval($cohort->year) == $cyear && $cohort->semester == $semester) {
                $this->enroll($e);
            } else {
                $this->randomStatus($e);
            }
        }
    }
}
