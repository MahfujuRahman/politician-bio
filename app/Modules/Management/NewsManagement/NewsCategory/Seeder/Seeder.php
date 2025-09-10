<?php
namespace App\Modules\Management\NewsManagement\NewsCategory\Seeder;

use Illuminate\Database\Seeder as SeederClass;
use Faker\Factory as Faker;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="App\Modules\Management\NewsManagement\NewsCategory\Seeder\Seeder"
     */
    static $model = \App\Modules\Management\NewsManagement\NewsCategory\Models\Model::class;

    public function run(): void
    {
        $faker = Faker::create();
        self::$model::truncate();

        for ($i = 1; $i <= 100; $i++) {
            self::$model::create([                'title' => $faker->text(50),
            ]);
        }
    }
}