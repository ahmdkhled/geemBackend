<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class user extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
   $faker= \Faker\Factory::create();
      $user=\App\Models\User::insert([
            'name'=>$faker->name,
            'email'=>$faker->email,
            'access-token'=>$faker->windowsPlatformToken,
            'status'=>$faker->numberBetween(0,1),
        ]);

        DB::table("user_details")->insert([
            'username'=>$faker->userName,
            'fullName'=>$faker->name,
            'gov'=>$faker->text,
            'role_id'=>2,
            'user_id'=>$faker->numberBetween(1,3),
            'category_id'=>$faker->numberBetween(1,9)
        ]);
    }
}
