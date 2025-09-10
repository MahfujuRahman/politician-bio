<?php
namespace App\Modules\Management\WhyChoseUsManagement\WhyChoseUs\Seeder;

use Illuminate\Database\Seeder as SeederClass;
use Faker\Factory as Faker;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="App\Modules\Management\WhyChoseUsManagement\WhyChoseUs\Seeder\Seeder"
     */
    static $model = \App\Modules\Management\WhyChoseUsManagement\WhyChoseUs\Models\Model::class;

    public function run(): void
    {
        $faker = Faker::create();
        self::$model::truncate();

        for ($i = 1; $i <= 100; $i++) {
            self::$model::create([                'title' => $faker->text(30),
                'description' => $faker->text,
                'icon' => $faker->text(50),
            ]);
        }
    }
}