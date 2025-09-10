<?php
namespace App\Modules\Management\OurSpeechesManagement\OurSpeeches\Seeder;

use Illuminate\Database\Seeder as SeederClass;
use Faker\Factory as Faker;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="App\Modules\Management\OurSpeechesManagement\OurSpeeches\Seeder\Seeder"
     */
    static $model = \App\Modules\Management\OurSpeechesManagement\OurSpeeches\Models\Model::class;

    public function run(): void
    {
        $faker = Faker::create();
        self::$model::truncate();

        for ($i = 1; $i <= 100; $i++) {
            self::$model::create([                'date' => $faker->date,
                'tag' => $faker->text(20),
                'title' => $faker->text(50),
                'thumbnail_image' => null,
                'video_url' => $faker->text(200),
            ]);
        }
    }
}