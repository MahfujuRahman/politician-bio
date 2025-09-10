<?php
namespace App\Modules\Management\IssuesManagement\Issues\Seeder;

use Illuminate\Database\Seeder as SeederClass;
use Faker\Factory as Faker;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="App\Modules\Management\IssuesManagement\Issues\Seeder\Seeder"
     */
    static $model = \App\Modules\Management\IssuesManagement\Issues\Models\Model::class;

    public function run(): void
    {
        $faker = Faker::create();
        self::$model::truncate();

        for ($i = 1; $i <= 100; $i++) {
            self::$model::create([                'title' => $faker->text(50),
                'short_description' => $faker->paragraph,
                'description' => $faker->text,
                'image' => null,
                'taking_action' => json_encode([$faker->word, $faker->word]),
                'tag' => $faker->text(20),
            ]);
        }
    }
}