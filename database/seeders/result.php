<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class result extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker= \Faker\Factory::create();
        DB::table("results")->insert([
            'result'=>$faker->numberBetween(10,20),
            'user_id'=>$faker->numberBetween(1,5),
            'exam_id'=>$faker->numberBetween(1,10)
        ]);
    }
}
