<?php
namespace App\Modules\Management\AboutUsManagement\AboutUs\Seeder;

use Illuminate\Database\Seeder as SeederClass;
use Faker\Factory as Faker;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="App\Modules\Management\AboutUsManagement\AboutUs\Seeder\Seeder"
     */
    static $model = \App\Modules\Management\AboutUsManagement\AboutUs\Models\Model::class;

    public function run(): void
    {
        $faker = Faker::create();
        self::$model::truncate();

        for ($i = 1; $i <= 100; $i++) {
            self::$model::create([                'title' => $faker->text(50),
                'description' => $faker->paragraph,
                'quotation' => $faker->text(200),
                'features' => json_encode([$faker->word, $faker->word]),
                'video_url' => $faker->text(200),
                'image' => null,
                'facts_figures' => json_encode([$faker->word, $faker->word]),
            ]);
        }
    }
}