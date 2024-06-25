<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;


use App\Models\Project;
use App\Models\Type;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        // array types
        $arrayTypes = [
            [
                'name' => 'science',
                'color' => 'green',
            ],
            [
                'name' => 'mathematics',
                'color' => 'blue',
            ],
            [
                'name' => 'informatics',
                'color' => 'red',
            ],
            [
                'name' => 'psychology',
                'color' => 'gold',
            ],
        ];

        // create record for table types
        foreach ($arrayTypes as $curType) {
            $type = new Type();
            $type->name = $curType['name'];
            $type->color = $curType['color'];
            $type->save();
        }

        // create record for table projects
        for ($i = 0; $i < 50; $i++) {
            $project = new Project();
            $project->title = $faker->sentence(3);
            $project->type_id = $faker->numberBetween(1,4);
            $project->description = $faker->text(255);
            $project->slug = Str::slug($project->title);
            $project->save();
        }

    }
}
