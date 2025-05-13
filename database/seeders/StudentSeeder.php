<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Student;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        echo "Seeding Students\n";
        Student::insert([
            ['name' => 'Danial Warren', 'github' => 'accessibleloving'],
            ['name' => 'Aman Milne', 'github' => 'digressacquire'],
            ['name' => 'Terri Mill', 'github' => 'learningphilips'],
            ['name' => 'Jennifer Washington', 'github' => 'wordynepalese'],
            ['name' => 'Veronika Sheldon', 'github' => 'fishcrochet'],
            ['name' => 'Rick Burch', 'github' => 'disruptiveimmature'],
            ['name' => 'Jay Croft', 'github' => 'greetwhirr'],
            ['name' => 'Bryson Holder', 'github' => 'childishacoustic'],
            ['name' => 'Aubrey Gross', 'github' => 'birthalligator'],
            ['name' => 'Ozan Nelson', 'github' => 'firmport'],
            ['name' => 'Tyler Dixon', 'github' => 'perdefinitive'],
            ['name' => 'Trent Lister', 'github' => 'cornettotight'],
            ['name' => 'Lucian Russo', 'github' => 'nosyfacility'],
            ['name' => 'Freja Noble', 'github' => 'aloofdapper'],
            ['name' => 'Vishal Forbes', 'github' => 'surfersquid'],
            ['name' => 'Isabella Rich', 'github' => 'curlytiding'],
            ['name' => 'Dahlia Robertson', 'github' => 'tricklerestroom'],
            ['name' => 'Jessie Keith', 'github' => 'stridentcowardly'],
            ['name' => 'Lyla Owen', 'github' => 'tamarinarsonist'],
            ['name' => 'Bethany Maynard', 'github' => 'unevenreliable'],
            ['name' => 'Addison Langley', 'github' => 'aukdango'],
            ['name' => 'Madina Anthony', 'github' => 'bisonperpetual'],
            ['name' => 'Neo Mullins', 'github' => 'twangratline'],
            ['name' => 'Alysia Kerr', 'github' => 'funflustered'],
            ['name' => 'Yash Huber', 'github' => 'delectablesight'],
            ['name' => 'Keelan Ahmed', 'github' => 'abortivepatient'],
            ['name' => 'Kali Wheeler', 'github' => 'egyptianfound'],
            ['name' => 'Hadassah Gilliam', 'github' => 'ordinaryjazzy'],
            ['name' => 'Liliana Hassan', 'github' => 'recoveryfencing'],
            ['name' => 'Usaamah Hagan', 'github' => 'cognitivehopeless'],
            ['name' => 'Joanne Hartley', 'github' => 'angelthus'],
            ['name' => 'Korey Barron', 'github' => 'weatherlyhuge'],
            ['name' => 'Zubair Avery', 'github' => 'achemosquitoe'],
            ['name' => 'Sahra Mcknight', 'github' => 'layerglobe'],
            ['name' => 'Zhane Lu', 'github' => 'peevishbore'],
            ['name' => 'Erik Coombes', 'github' => 'unpackshades'],
            ['name' => 'Kadeem Spence', 'github' => 'homelessurethra'],
            ['name' => 'Bella Jackson', 'github' => 'dashikicoarse'],
            ['name' => 'Ozan Partridge', 'github' => 'writhingfade'],
            ['name' => 'Imani Berry', 'github' => 'shadyexaggerate'],
            ['name' => 'Lily-Grace Preston', 'github' => 'excitingplead'],
            ['name' => 'Elen Sparrow', 'github' => 'trouporacle'],
            ['name' => 'Cerys Langley', 'github' => 'himselfsardines'],
            ['name' => 'Corrina Reese', 'github' => 'swissunable'],
            ['name' => 'Antoni Washington', 'github' => 'nineghast'],
            ['name' => 'Gideon Levine', 'github' => 'intelskirt'],
            ['name' => 'Marnie Millington', 'github' => 'greenprincipal'],
            ['name' => 'Kirstin Ashley', 'github' => 'crabbyrecord'],
            ['name' => 'Jordan Patton', 'github' => 'coolsock'],
            ['name' => 'Mollie Choi', 'github' => 'helmetoriginally'],
            ['name' => 'Elena Ryan', 'github' => 'morbiditylunch'],
            ['name' => 'Mali Cartwright', 'github' => 'longscuttles'],
            ['name' => 'Kieren Redfern', 'github' => 'wantingbutler'],
            ['name' => 'Kaylum Hampton', 'github' => 'lifejacketfavorite'],
            ['name' => 'Carlos Bourne', 'github' => 'septumweapon'],
            ['name' => 'Scott Peel', 'github' => 'minidisctapir'],
            ['name' => 'Isaac Rivas', 'github' => 'womenstroubled'],
            ['name' => 'Julie Kay', 'github' => 'goodpox'],
            ['name' => 'Felicity Dudley', 'github' => 'outrageousleotard'],
            ['name' => 'Nylah Quintana', 'github' => 'courteouspiercer'],
        ]);
        $students = Student::all();
        foreach ($students as $student) {
            $student = $student->setDefaults();
        }
    }
}
