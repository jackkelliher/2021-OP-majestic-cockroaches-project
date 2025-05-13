<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Cohort;

class CohortSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        echo "Seeding Cohorts\n";
        Cohort::insert([

            ['subject' => 'Studio3', 'year' => '2020', 'semester' => '1'],
            ['subject' => 'Studio4', 'year' => '2020', 'semester' => '1'],
            ['subject' => 'Studio5', 'year' => '2020', 'semester' => '1'],
            ['subject' => 'Studio6', 'year' => '2020', 'semester' => '1'],
            ['subject' => 'Studio3', 'year' => '2020', 'semester' => '2'],
            ['subject' => 'Studio4', 'year' => '2020', 'semester' => '2'],
            ['subject' => 'Studio5', 'year' => '2020', 'semester' => '2'],
            ['subject' => 'Studio6', 'year' => '2020', 'semester' => '2'],
            ['subject' => 'Studio3', 'year' => '2020', 'semester' => 'S'],
            ['subject' => 'Studio4', 'year' => '2020', 'semester' => 'S'],
            ['subject' => 'Studio5', 'year' => '2020', 'semester' => 'S'],
            ['subject' => 'Studio6', 'year' => '2020', 'semester' => 'S']

        ]);
        Cohort::insert([
            ['subject' => 'Studio3', 'year' => '2020', 'semester' => '1', 'stream' => 'B'],
            ['subject' => 'Studio5', 'year' => '2020', 'semester' => '1', 'stream' => 'B'],
            ['subject' => 'Studio4', 'year' => '2020', 'semester' => '2', 'stream' => 'B'],
            ['subject' => 'Studio6', 'year' => '2020', 'semester' => '2', 'stream' => 'B']
        ]);

        Cohort::insert([
            ['subject' => 'Studio3', 'year' => '2021', 'semester' => '1'],
            ['subject' => 'Studio4', 'year' => '2021', 'semester' => '1'],
            ['subject' => 'Studio5', 'year' => '2021', 'semester' => '1'],
            ['subject' => 'Studio6', 'year' => '2021', 'semester' => '1'],
            ['subject' => 'Studio3', 'year' => '2021', 'semester' => '2'],
            ['subject' => 'Studio4', 'year' => '2021', 'semester' => '2'],
            ['subject' => 'Studio5', 'year' => '2021', 'semester' => '2'],
            ['subject' => 'Studio6', 'year' => '2021', 'semester' => '2'],
            ['subject' => 'Studio3', 'year' => '2021', 'semester' => 'S'],
            ['subject' => 'Studio4', 'year' => '2021', 'semester' => 'S'],
            ['subject' => 'Studio5', 'year' => '2021', 'semester' => 'S'],
            ['subject' => 'Studio6', 'year' => '2021', 'semester' => 'S']

        ]);

        Cohort::insert([
            ['subject' => 'Studio3', 'year' => '2021', 'semester' => '1', 'stream' => 'B'],
            ['subject' => 'Studio5', 'year' => '2021', 'semester' => '1', 'stream' => 'B'],
            ['subject' => 'Studio4', 'year' => '2021', 'semester' => '2', 'stream' => 'B'],
            ['subject' => 'Studio6', 'year' => '2021', 'semester' => '2', 'stream' => 'B']

        ]);


        Cohort::insert([
            ['subject' => 'Studio3', 'year' => '2022', 'semester' => '1'],
            ['subject' => 'Studio4', 'year' => '2022', 'semester' => '1'],
            ['subject' => 'Studio5', 'year' => '2022', 'semester' => '1'],
            ['subject' => 'Studio6', 'year' => '2022', 'semester' => '1'],
            ['subject' => 'Studio3', 'year' => '2022', 'semester' => '2'],
            ['subject' => 'Studio4', 'year' => '2022', 'semester' => '2'],
            ['subject' => 'Studio5', 'year' => '2022', 'semester' => '2'],
            ['subject' => 'Studio6', 'year' => '2022', 'semester' => '2'],
            ['subject' => 'Studio3', 'year' => '2022', 'semester' => 'S'],
            ['subject' => 'Studio4', 'year' => '2022', 'semester' => 'S'],
            ['subject' => 'Studio5', 'year' => '2022', 'semester' => 'S'],
            ['subject' => 'Studio6', 'year' => '2022', 'semester' => 'S']

        ]);


        Cohort::insert([
            ['subject' => 'Studio3', 'year' => '2022', 'semester' => '1', 'stream' => 'B'],
            ['subject' => 'Studio5', 'year' => '2022', 'semester' => '1', 'stream' => 'B'],
            ['subject' => 'Studio4', 'year' => '2022', 'semester' => '2', 'stream' => 'B'],
            ['subject' => 'Studio6', 'year' => '2022', 'semester' => '2', 'stream' => 'B']

        ]);
        Cohort::insert([
            ['subject' => 'Studio3', 'year' => '2023', 'semester' => '1'],
            ['subject' => 'Studio4', 'year' => '2023', 'semester' => '1'],
            ['subject' => 'Studio5', 'year' => '2023', 'semester' => '1'],
            ['subject' => 'Studio6', 'year' => '2023', 'semester' => '1'],
            ['subject' => 'Studio3', 'year' => '2023', 'semester' => '2'],
            ['subject' => 'Studio4', 'year' => '2023', 'semester' => '2'],
            ['subject' => 'Studio5', 'year' => '2023', 'semester' => '2'],
            ['subject' => 'Studio6', 'year' => '2023', 'semester' => '2'],
            ['subject' => 'Studio6', 'year' => '2024', 'semester' => '2'],
            ['subject' => 'Studio3', 'year' => '2023', 'semester' => 'S'],
            ['subject' => 'Studio4', 'year' => '2023', 'semester' => 'S'],
            ['subject' => 'Studio5', 'year' => '2023', 'semester' => 'S'],
            ['subject' => 'Studio6', 'year' => '2023', 'semester' => 'S']

        ]);
        Cohort::insert([
            ['subject' => 'Studio3', 'year' => '2023', 'semester' => '1', 'stream' => 'B'],
            ['subject' => 'Studio5', 'year' => '2023', 'semester' => '1', 'stream' => 'B'],
            ['subject' => 'Studio4', 'year' => '2023', 'semester' => '2', 'stream' => 'B'],
            ['subject' => 'Studio6', 'year' => '2023', 'semester' => '2', 'stream' => 'B']

        ]);
        Cohort::insert([
            ['subject' => 'Studio3', 'year' => '2024', 'semester' => '1'],
            ['subject' => 'Studio4', 'year' => '2024', 'semester' => '1'],
            ['subject' => 'Studio5', 'year' => '2024', 'semester' => '1'],
            ['subject' => 'Studio6', 'year' => '2024', 'semester' => '1'],
            ['subject' => 'Studio3', 'year' => '2024', 'semester' => '2'],
            ['subject' => 'Studio4', 'year' => '2024', 'semester' => '2'],
            ['subject' => 'Studio5', 'year' => '2024', 'semester' => '2'],
            ['subject' => 'Studio3', 'year' => '2024', 'semester' => 'S'],
            ['subject' => 'Studio4', 'year' => '2024', 'semester' => 'S'],
            ['subject' => 'Studio5', 'year' => '2024', 'semester' => 'S'],
            ['subject' => 'Studio6', 'year' => '2024', 'semester' => 'S']

        ]);
        
        Cohort::insert([
            ['subject' => 'Studio3', 'year' => '2024', 'semester' => '1', 'stream' => 'B'],
            ['subject' => 'Studio5', 'year' => '2024', 'semester' => '1', 'stream' => 'B'],
            ['subject' => 'Studio4', 'year' => '2024', 'semester' => '2', 'stream' => 'B'],
            ['subject' => 'Studio6', 'year' => '2024', 'semester' => '2', 'stream' => 'B']

        ]);

        
        $cohorts =Cohort::all();
        foreach ($cohorts as $c) {
            $c->setDefaults();
        }
       
    }
    
}
