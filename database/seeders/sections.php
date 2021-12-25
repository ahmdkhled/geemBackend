<?php

namespace Database\Seeders;

use App\Models\material;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class sections extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $material=material::all();
        $faker= \Faker\Factory::create();
        DB::table("sections")->insert([
            "name"=>$faker->name,
            "material_id"=>$material[0]->id,

        ]);
    }
}
