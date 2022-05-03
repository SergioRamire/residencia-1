<?php

namespace Database\Seeders;

use App\Models\Coursesdetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CoursesdetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Coursesdetail::factory()
            ->count(10)
            ->create();
    }
}
