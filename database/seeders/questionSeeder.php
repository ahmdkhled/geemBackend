<?php

namespace Database\Seeders;

use App\Models\exam;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class questionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $exam=exam::all();
        $faker= \Faker\Factory::create();
        DB::table("questions")->insert([
            'textQuestion'=>$faker->paragraph,
            'exam_id'=>$exam[0]->id,
            'choices'=>json_encode([
                $faker->randomElement,
                $faker->randomElement,
                $faker->randomElement,
                $faker->randomElement,
            ])

            ]);
    }
}
