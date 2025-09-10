<?php
namespace App\Modules\Management\SectionHeadingManagement\SectionHeading\Seeder;

use Illuminate\Database\Seeder as SeederClass;
use Faker\Factory as Faker;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="App\Modules\Management\SectionHeadingManagement\SectionHeading\Seeder\Seeder"
     */
    static $model = \App\Modules\Management\SectionHeadingManagement\SectionHeading\Models\Model::class;

    public function run(): void
    {
        $faker = Faker::create();
        self::$model::truncate();

        for ($i = 1; $i <= 100; $i++) {
            self::$model::create([                'section_type' => $faker->text(50),
                'short_title' => null,
                'title' => $faker->text(200),
                'long_title' => $faker->paragraph,
                'short_description' => $faker->paragraph,
                'description' => $faker->text,
                'video_url' => $faker->text(150),
                'primary_image' => $faker->text(200),
                'background_image' => $faker->text(200),
                'side_image' => $faker->text(200),
                'image' => $faker->text(200),
                'special_note' => $faker->text,
            ]);
        }
    }
}