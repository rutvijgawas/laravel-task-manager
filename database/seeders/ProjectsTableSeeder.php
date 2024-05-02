<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use Database\Factories\ProjectsFactory;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::factory()->create([
            'name' => 'Netflix',
        ]);

        Project::factory()->create([
            'name' => 'Amazon Prime',
        ]);
        Project::factory()->create([
            'name' => 'Eros Now',
        ]);
        Project::factory()->create([
            'name' => 'Apple TV+',
        ]);
        Project::factory()->create([
            'name' => 'Crunchyroll',
        ]);
        Project::factory()->create([
            'name' => 'JioTV',
        ]);
    }
}
