<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Paper;
class PapersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        echo "Seeding Papers\n";
        Paper::insert([
            ['name' => 'Studio1','level'=>5], 
            ['name' => 'Studio2','level'=>5], 
            ['name' => 'Studio3', 'level'=>6], 
            ['name' => 'Studio4', 'level'=>6], 
            ['name' => 'Studio5', 'level'=>7], 
            ['name' => 'Studio6', 'level'=>7], 
        ]);
        $papers = Paper::all();
        foreach($papers as $p){
            $p->setCode();
        }
    }
}
