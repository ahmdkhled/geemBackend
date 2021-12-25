<?php

namespace Database\Seeders;

use App\Models\exam;
use App\Models\subSection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class exams_subsectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $exam=exam::all();
        $sub=subSection::all();
        $faker= \Faker\Factory::create();
        //for($i=count($exam);$i <0; $i++)
        //{

        DB::table("exam_sub_section")->insert([
            'exam_id'=>$exam[3]->id,
            'subsection_id'=>$sub[5]->id,
        ]);
        //}
    }
}
