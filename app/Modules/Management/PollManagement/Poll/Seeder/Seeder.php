<?php
namespace App\Modules\Management\PollManagement\Poll\Seeder;

use Illuminate\Database\Seeder as SeederClass;
use Faker\Factory as Faker;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="App\Modules\Management\PollManagement\Poll\Seeder\Seeder"
     */
    static $model = \App\Modules\Management\PollManagement\Poll\Models\Model::class;

    public function run(): void
    {
        $faker = Faker::create();
        self::$model::truncate();

        for ($i = 1; $i <= 100; $i++) {
            self::$model::create([                'title' => $faker->text(100),
                'description' => $faker->text,
                'image' => $faker->text(150),
                'is_voting' => $faker->randomElement(array (
  0 => '0',
  1 => '1',
)),
            ]);
        }
    }
}