<?php

namespace Database\Seeders;

use App\Models\category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class materials extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category=category::all();
        $faker= \Faker\Factory::create();
        DB::table("materials")->insert([
            "name"=>$faker->name,
            "category_id"=>$category[0]->id,


        ]);
    }
}
