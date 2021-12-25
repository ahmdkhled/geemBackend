<?php

namespace Database\Seeders;

use App\Models\material;
use App\Models\section;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class subsections extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $section=section::all();
        $faker= \Faker\Factory::create();
        DB::table("sub_sections")->insert([
            "name"=>$faker->name,
            "section_id"=>$section[3]->id,
        ]);
    }
}
