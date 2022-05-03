<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $this->call([
            AreaSeeder::class,
            UserSeeder::class,
            CourseSeeder::class,
            GroupSeeder::class,
            CoursesdetailSeeder::class,
            InscriptionSeeder::class,
            GroupassignmentSeeder::class,
        ]);
    }
}
