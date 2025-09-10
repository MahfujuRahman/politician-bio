<?php
namespace App\Modules\Management\OurPrinciplesManagement\OurPrinciples\Seeder;

use Illuminate\Database\Seeder as SeederClass;
use Faker\Factory as Faker;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="App\Modules\Management\OurPrinciplesManagement\OurPrinciples\Seeder\Seeder"
     */
    static $model = \App\Modules\Management\OurPrinciplesManagement\OurPrinciples\Models\Model::class;

    public function run(): void
    {
        $faker = Faker::create();
        self::$model::truncate();

        for ($i = 1; $i <= 100; $i++) {
            self::$model::create([                'title' => $faker->text(30),
                'description' => $faker->paragraph,
                'icon' => $faker->text(30),
            ]);
        }
    }
}