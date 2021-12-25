<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
       $this->call([
           categorySeeder::class,
           materials::class,
           sections::class,
           subsections::class,
           exams::class,
           exams_subsectionSeeder::class,
           questionSeeder::class,
           result::class,
           user::class


           ]);
    }
}
