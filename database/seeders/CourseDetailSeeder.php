<?php

namespace Database\Seeders;

use App\Models\CourseDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CourseDetail::factory()
            ->count(10)
            ->create();
    }
}
