<?php
namespace App\Modules\Management\ServicesManagement\Services\Seeder;

use Illuminate\Database\Seeder as SeederClass;
use Faker\Factory as Faker;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="App\Modules\Management\ServicesManagement\Services\Seeder\Seeder"
     */
    static $model = \App\Modules\Management\ServicesManagement\Services\Models\Model::class;

    public function run(): void
    {
        $faker = Faker::create();
        self::$model::truncate();

        for ($i = 1; $i <= 100; $i++) {
            self::$model::create([                'icon' => $faker->text(30),
                'title' => $faker->text(100),
                'short_title' => $faker->text(100),
                'description' => $faker->text,
                'image' => null,
                'statistics' => json_encode([$faker->word, $faker->word]),
            ]);
        }
    }
}