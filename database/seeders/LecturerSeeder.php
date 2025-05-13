<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Lecturer;

class LecturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        echo "Seeding Lecturers\n";
        Lecturer::insert([
            ['name' => 'Manu Keyes','password' => bcrypt('password')],
            ['name' => 'Jeanna Byrd', 'password' => bcrypt('password')],
            ['name' => 'Michael Butler', 'password' => bcrypt('password')],
            ['name' => 'Royce McDaniel','password' => bcrypt('password')],
            ['name' => 'Jed McCabe', 'password' => bcrypt('password')],
            ['name' => 'Morgan Okamura', 'password' => bcrypt('password')],
            ['name' => 'Evelien Ridley','password' => bcrypt('password')],
            ['name' => 'Deirdre Marino','password' => bcrypt('password')],
            ['name' => 'Zachary Wilkins','password' => bcrypt('password')]
        ]);
        $lecturers = Lecturer::all();
        foreach($lecturers as $l){
            $l->setDefaults();
        }    
    }
}
