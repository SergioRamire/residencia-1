<?php

namespace Database\Seeders;

use App\Models\GroupAssignment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupAssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GroupAssignment::factory()
            ->count(5)
            ->create();
    }
}
