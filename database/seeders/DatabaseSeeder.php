<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\User;
use App\Models\Project;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        

        Project::factory(5)->create();

        Author::factory(5)->create();


        $projects = Project::all();
        $authors = Author::all();
        foreach ($projects as $project) {
            $project->authors()->attach(
                $authors->random(rand(1, 3))->pluck('id')->toArray()
            );
        }
        
        
    }
}
