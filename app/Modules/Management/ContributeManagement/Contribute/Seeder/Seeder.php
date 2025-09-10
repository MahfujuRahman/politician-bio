<?php
namespace App\Modules\Management\ContributeManagement\Contribute\Seeder;

use Illuminate\Database\Seeder as SeederClass;
use Faker\Factory as Faker;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="App\Modules\Management\ContributeManagement\Contribute\Seeder\Seeder"
     */
    static $model = \App\Modules\Management\ContributeManagement\Contribute\Models\Model::class;

    public function run(): void
    {
        $faker = Faker::create();
        self::$model::truncate();

        for ($i = 1; $i <= 100; $i++) {
            self::$model::create([                'short_title' => $faker->text(30),
                'title' => $faker->text(30),
                'description' => $faker->paragraph,
                'image' => null,
            ]);
        }
    }
}