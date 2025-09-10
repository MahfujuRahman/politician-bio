<?php
namespace App\Modules\Management\EventManagement\Speakers\Seeder;

use Illuminate\Database\Seeder as SeederClass;
use Faker\Factory as Faker;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="App\Modules\Management\EventManagement\Speakers\Seeder\Seeder"
     */
    static $model = \App\Modules\Management\EventManagement\Speakers\Models\Model::class;

    public function run(): void
    {
        $faker = Faker::create();
        self::$model::truncate();

        for ($i = 1; $i <= 100; $i++) {
            self::$model::create([                'event_id' => null,
                'name' => $faker->text(50),
                'designation' => $faker->text(50),
                'image' => null,
                'social_link' => json_encode([$faker->word, $faker->word]),
            ]);
        }
    }
}