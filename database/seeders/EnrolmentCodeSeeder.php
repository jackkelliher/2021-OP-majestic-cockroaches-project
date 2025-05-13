<?php

namespace Database\Seeders;
use App\EnrolmentCode;
use Illuminate\Database\Seeder;

class EnrolmentCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        echo "Seeding Enrolment Code\n";
        EnrolmentCode::insert([
            ['status' => 'Enrolled'], 
            ['status' => 'Withdrawn'], 
            ['status' => 'Passed'], 
            ['status' => 'Failed'] 
        ]);
    }
}
