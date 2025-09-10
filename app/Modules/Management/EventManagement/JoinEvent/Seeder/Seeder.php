<?php
namespace App\Modules\Management\EventManagement\JoinEvent\Seeder;

use Illuminate\Database\Seeder as SeederClass;
use Faker\Factory as Faker;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="App\Modules\Management\EventManagement\JoinEvent\Seeder\Seeder"
     */
    static $model = \App\Modules\Management\EventManagement\JoinEvent\Models\Model::class;

    public function run(): void
    {
        $faker = Faker::create();
        self::$model::truncate();

        for ($i = 1; $i <= 100; $i++) {
            self::$model::create([                'event_id' => null,
                'name' => $faker->text(100),
                'email' => $faker->text(100),
                'mobile_number' => $faker->text(20),
                'comment' => $faker->paragraph,
            ]);
        }
    }
}