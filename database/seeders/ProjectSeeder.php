<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Models
use App\Models\Project;
use App\Models\Type;

// Helpers
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 200; $i++) {
            $title = $faker->unique()->sentence(4);

            Project::create([
                'title' => $faker->sentence(4),
                'slug' => Str::slug($title),
                'stars' => $faker->numberBetween(0, 100),
                'commits' => $faker->numberBetween(0, 100),
                'type_id' => Type::inRandomOrder()->first()->id
            ]);
        }
    }
}
