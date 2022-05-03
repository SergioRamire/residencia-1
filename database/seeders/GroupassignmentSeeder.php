<?php

namespace Database\Seeders;

use App\Models\Groupassignment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupassignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Groupassignment::factory()
            ->count(5)
            ->create();
    }
}
