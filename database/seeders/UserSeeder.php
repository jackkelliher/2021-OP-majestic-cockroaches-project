<?php

namespace Database\Seeders;

use App\Lecturer;
use App\Student;
use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //creates a user in the database so they can login
        echo "Seeding Users\n";
        User::create(array(
            'username' => 'admin',
            'type' => 'admin',
            'password' => bcrypt('aMoreSecureP@ssw0rd'),
            'email' => 'admin@hotmail.com',
            'name' => 'Admin User',
        ));
        
        $lecturers = Lecturer::all();
        foreach ($lecturers as $l) {
            User::create(array(
                'username' => $l->username,
                'type' => 'lecturer',
                'password' => $l->password,
                'email' =>$l->email,
                'name' => $l->name
            ));
        }

        $students = Student::all();
        foreach($students as $s){
            User::create(array(
                'username' => $s->username,
                'type' => 'student',
                'password' => bcrypt( $s->github),
                'email' =>$s->email,
                'name' => $s->name
            ));
        }
    }
}
